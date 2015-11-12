<?php

namespace JS\Services\Identity\Test;

use GuzzleHttp\Client;
use JS\Services\Identity\IdentityClientFactory;

class IdentityClientFactoryTest extends \PHPUnit_Framework_TestCase
{

    public function testCreateFailure()
    {
        $factory = new IdentityClientFactory(new Client(), 'url', []);

        $client = $factory->create();

        $description = $client->getDescription();

        $this->assertInstanceOf('GuzzleHttp\Command\Guzzle\Description', $description);

        $this->assertTrue($description->hasOperation('Login'));
        $this->assertTrue($description->hasOperation('GetUserData'));

    }
}