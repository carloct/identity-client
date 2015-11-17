<?php

namespace JS\Services\Products;

use JS\Services\Products\Contracts\FactoryInterface;
use JS\Services\Products\Descriptions\ProductsDescription;
use GuzzleHttp\Command\Guzzle\GuzzleClient;
use GuzzleHttp\Client;

class ProductsClientFactory implements FactoryInterface
{
    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * @var string
     */
    private $baseUrl;

    /**
     * @var array
     */
    private $config;

    public function __construct(Client $client, $baseUrl, $config)
    {
        $this->client  = $client;
        $this->baseUrl = $baseUrl;
        $this->config  = $config;

        $this->client->setDefaultOption('auth', $this->config);
    }

    /**
     * Create the GuzzleClient
     *
     * @return GuzzleClient
     */
    public function create()
    {
        return new GuzzleClient($this->client, $this->getServiceDescription(), $this->config);
    }

    /**
     * Guzzle Service Description
     *
     * @return \GuzzleHttp\Command\Guzzle\Description
     */
    private function getServiceDescription()
    {
        return ProductsDescription::get($this->baseUrl);
    }

}