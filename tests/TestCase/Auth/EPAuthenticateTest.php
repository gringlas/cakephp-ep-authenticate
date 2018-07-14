<?php
/**
 * Created by IntelliJ IDEA.
 * User: sebastiankoller
 * Date: 14.07.18
 * Time: 11:46
 */

namespace gringlas\EPAuthenticate\Auth\Test\TestCase\Auth;


use Cake\Controller\ComponentRegistry;
use Cake\Http\Response;
use Cake\Http\ServerRequest;
use Cake\TestSuite\TestCase;
use gringlas\EPAuthenticate\Auth\EPAuthenticate;

class EPAuthenticateTest extends TestCase
{

    /**
     * @var EPAuthenticate
     */
    private $EPAuthenticate;


    private $request;

    public function setUp()
    {
        parent::setUp();
        $this->Registry = new ComponentRegistry();
        $this->Auth = new EPAuthenticate($this->Registry, [
        ]);
        $this->Registry->Auth = $this->auth;
        $this->Response = $this->getMockBuilder(Response::class)
            ->getMock();

    }


    public function testGetUser()
    {
        $request = new ServerRequest('posts/index');
        $auth = new EPAuthenticate($this->Registry);
        $this->assertTrue($auth->getUser($request));
    }

    public function tearDown()
    {
        parent::tearDown();
        // Clean up after we're done
        unset($this->component, $this->controller);
    }
}
