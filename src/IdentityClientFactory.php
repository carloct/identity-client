<?php

namespace JS\Services\Identity;

use JS\Services\Identity\Contracts\FactoryInterface;
use JS\Services\Identity\Descriptions\IdentityDescription;
use GuzzleHttp\Command\Guzzle\GuzzleClient;
use GuzzleHttp\Client;

class IdentityClientFactory implements FactoryInterface
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
        return IdentityDescription::get($this->baseUrl);
    }

}