<?php

namespace JS\Services\Products\Test;

use GuzzleHttp\Client;
use JS\Services\Products\ProductsClientFactory;

class ProductsClientFactoryTest extends \PHPUnit_Framework_TestCase
{

    public function testCreateFailure()
    {
        $factory = new ProductsClientFactory(new Client(), 'url', []);

        $client = $factory->create();

        $description = $client->getDescription();

        $this->assertInstanceOf('GuzzleHttp\Command\Guzzle\Description', $description);

        $this->assertTrue($description->hasOperation('getAllCategories'));

    }
}