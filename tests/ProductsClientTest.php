<?php

namespace JS\Services\Products\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Subscriber\Mock;
use GuzzleHttp\Stream\Stream;
use JS\Services\Products\ProductsClient;
use JS\Services\Products\ProductsClientFactory;
use Mockery as m;

class ProductsClientTest extends \PHPUnit_Framework_TestCase
{
    protected $guzzle;
    protected $fixtures;

    public function setUp()
    {
        $this->guzzle = new Client();
        $this->fixtures = __DIR__.'/fixtures/';

    }

    public function testGetAllCategories()
    {
        $mock = new Mock([
            new Response(200, [], Stream::factory(file_get_contents($this->fixtures . 'getAllCategories.json')))
        ]);

        $this->guzzle->getEmitter()->attach($mock);

        $factory = new ProductsClientFactory($this->guzzle, 'http://dev.null', []);
        $client = new ProductsClient($factory);

        $response = $client->getAllCategories();

        $this->assertTrue(is_array($response));

    }

    public function testGetProductsByCategory()
    {
        $mock = new Mock([
            new Response(200, [], Stream::factory(file_get_contents($this->fixtures . 'getProductsByCategory.json')))
        ]);

        $this->guzzle->getEmitter()->attach($mock);

        $factory = new ProductsClientFactory($this->guzzle, 'http:/dev.null', []);
        $client = new ProductsClient($factory);

        $response = $client->getProductsByCategory(100001);

        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('category', $response);
    }

    public function testGetProductBySku()
    {
        $mock = new Mock([
            new Response(200, [], Stream::factory(file_get_contents($this->fixtures . 'getProductBySku.json')))
        ]);

        $this->guzzle->getEmitter()->attach($mock);

        $factory = new ProductsClientFactory($this->guzzle, 'http://public-api.texan.uk/products/', []);
        $client = new ProductsClient($factory);

        $response = $client->getProductBySku(5104);

        $this->assertTrue(is_array($response));
        $this->assertArrayHasKey('sku', $response);
    }





}