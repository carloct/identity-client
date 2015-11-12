<?php

namespace JS\Services\Identity\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Subscriber\Mock;
use GuzzleHttp\Stream\Stream;
use JS\Services\Identity\IdentityClient;
use JS\Services\Identity\IdentityClientFactory;
use Mockery as m;

class IdentityClientTest extends \PHPUnit_Framework_TestCase
{
    protected $guzzle;

    public function setUp()
    {
        $this->guzzle = new Client();
    }

    /**
     * @expectedException GuzzleHttp\Command\Exception\CommandException
     */
    public function testLoginWithoutGrantType()
    {
        $mock = new Mock([
            new Response(401, [], Stream::factory('
            {
                "detail": "The grant type was not specified in the request",
                "status": 400,
                "title": "Bad Request"
            }
            '))
        ]);

        $this->guzzle->getEmitter()->attach($mock);

        $factory = new IdentityClientFactory($this->guzzle, 'http://foo.bar', []);
        $client = new IdentityClient($factory);

        $client->login([
            'username' => 'testuser',
            'password' => 'testpass'
        ]);
    }

    /**
     * @expectedException JS\Services\Identity\Exceptions\BadloginException
     */
    public function testLoginWithWrongCredentials()
    {
        $mock = new Mock([
            new Response(401, [], Stream::factory('
            {
                "detail": "Invalid username and password combination",
                "status": 401,
                "title": "Unauthorized"
            }
            '))
        ]);

        $this->guzzle->getEmitter()->attach($mock);

        $factory = new IdentityClientFactory($this->guzzle, 'http://foo.bar', []);
        $client = new IdentityClient($factory);

        $client->login([
            'grant_type'    => 'password',
            'username'      => 'testuser',
            'password'      => 'wrongpassword'
        ]);
    }

    public function testLoginSuccess()
    {
        $mock = new Mock([
            new Response(200, [], Stream::factory('
            {
                "access_token": "token",
                "expires_in": 3600,
                "token_type": "Bearer",
                "scope": "openid",
                "refresh_token": "refresh_token"
            }
            '))
        ]);

        $this->guzzle->getEmitter()->attach($mock);
        $factory = new IdentityClientFactory($this->guzzle, 'http://foo.bar', []);
        $client = new IdentityClient($factory);

        $response = $client->login([
            'grant_type'    => 'password',
            'username'      => 'testuser',
            'password'      => 'correctpassword'
        ]);

        $this->assertArrayHasKey('access_token', $response);
        $this->assertArrayHasKey('expires_in', $response);
        $this->assertArrayHasKey('token_type', $response);
        $this->assertArrayHasKey('scope', $response);
        $this->assertArrayHasKey('refresh_token', $response);

    }
}