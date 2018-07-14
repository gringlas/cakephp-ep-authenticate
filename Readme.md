# CakePHP EPAuthenticate Plugin 
This little plugin provides an Authenticate adapter for stateless Authentication. It allows you to specify a special header, which contains a token to authorize in your application. This can be very helpful for testing, be it unittests or manual tests with API clients (like Postman) or directly in your client software.

## Installation

````
composer require gringlas/cakephp-ep-authenticate dev-master
````

## Usage

Just add `gringlas/EPAuthenticate.EP` to your AuthComponent authenticate, like 

````
$this->loacComponent('Auth', [
    'authenticate' => [
        'header' => 'EP-Authorization',
            'userId' => 1,
            'debugOnly' => false,
            'password' => 'EPme',
        ],
        ...
        );
````

## Configratiion

- `userId`: Id of User data, which should be authed, defaults to 1
- `debugOnly`: only use AuthenticateAdapter when `env('debug', true)`, defaults to true
- `header`: Name of header, defaults to `EP-Authorization`
- `password`: Value of header, defaults to `EPme`
