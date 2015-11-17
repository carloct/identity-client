<?php

namespace JS\Services\Products;

use JS\Services\Products\Contracts\FactoryInterface;

class ProductsClient implements ProductsClientInterface
{
    /**
     * Identity service client
     * @var GuzzleClient
     */
    protected $client;

    /**
     * Guzzle options
     *
     * @var array
     */
    private $options = [];

    /**
     * Constructor
     * @param FactoryInterface $serviceFactory
     */
    public function __construct(FactoryInterface $serviceClientFactory)
    {
        $this->client = $serviceClientFactory->create();
        $this->options['format'] = 'json';
    }

    /**
     * Get product by sku
     *
     * @param $sku
     * @return mixed
     */
    public function getProductBySku($sku)
    {
        $this->options['sku'] = $sku;

        return $this->client->getProductBySku($this->options);
    }


    /**
     *
     * Autocomplete service
     *
     * @param $query
     * @return Response
     */
    public function autocomplete($query, $category_id)
    {
        $this->options['query'] = $query;

        $this->options['category_id'] = $category_id;

        return $this->client->getSuggestions($this->options);
    }


    /**
     * Get categories tree
     *
     * @return Response
     */
    public function getAllCategories()
    {
        return $this->client->getAllCategories($this->options);
    }

    /**
     * Get products within a category
     *
     * @params $category_id
     * @params $query
     * @params $offset
     * @params $limit
     * @return array
     */
    public function getProductsByCategory($category_id, $offset = 0, $limit = 60, $query = '')
    {
        $this->options['category_id'] = $category_id;

        $this->options['offset'] = $offset;

        $this->options['limit'] = $limit;

        $this->options['query'] = $query;

        return $this->client->getProductsByCategory($this->options);
    }

}
