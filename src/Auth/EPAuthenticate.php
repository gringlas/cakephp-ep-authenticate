<?php
/**
 * Created by IntelliJ IDEA.
 * User: sebastiankoller
 * Date: 14.07.18
 * Time: 10:19
 */

namespace gringlas\EPAuthenticate\Auth;


use Cake\Auth\BaseAuthenticate;
use Cake\Controller\ComponentRegistry;
use Cake\Core\Configure;
use Cake\Http\Response;
use Cake\Http\ServerRequest;
use Cake\Network\Exception\UnauthorizedException;
use Cake\ORM\Locator\LocatorAwareTrait;

class EPAuthenticate extends BaseAuthenticate
{

    use LocatorAwareTrait;


    public function __construct(ComponentRegistry $registry, array $config = [])
    {
        $defaultConfig = [
            'debugOnly' => true,
            'header' => 'EP-Authorization',
            'userId' => 1,
            'password' => 'EPme',
            'unauthenticatedException' => UnauthorizedException::class,
        ];

        if (!class_exists(UnauthorizedException::class)) {
            $defaultConfig['unauthenticatedException'] = 'Cake\Network\Exception\UnauthorizedException';
        }

        $this->setConfig($defaultConfig);

        parent::__construct($registry, $config);
    }


    public function authenticate(ServerRequest $request, Response $response)
    {
        return $this->getUser($request);
    }

    public function getUser(ServerRequest $request)
    {
        $config = $this->_config;
        if ($this->checkDebugOnly() && $this->checkHeader($request)) {
            $user = $this->getTableLocator()->get($config['userModel'])
                ->get($this->getConfig('userId'));
            return $user->toArray();
        }
        return false;
    }


    private function checkDebugOnly()
    {
        if ($this->getConfig('debugOnly')) {
            return Configure::read('debug');
        }
        return true;
    }


    private function checkHeader(ServerRequest $request)
    {
        $header = $request->getHeader($this->getConfig('header'));
        $passwordCheck = $request->getHeaderLine($this->getConfig('header')) == $this->getConfig('password');
        return ($header && $passwordCheck);
    }
}
