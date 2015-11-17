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
     *
     * Fetch a list of products, can be paginated
     *
     * @param $page
     * @param $paginate
     * @return mixed
     */
    public function getAll($page, $paginate)
    {
        if (isset($page)) {
            $this->options['page'] = $page;
        }

        if (isset($paginate)) {
            $this->options['paginate'] = $paginate;
        }

        return $this->client->getProducts($this->options);
    }

    /**
     *
     * Get products by description, can be paginated
     *
     * @param $description
     * @param $page
     * @param $paginate
     * @return mixed
     */
    public function getByDescription($description, $page, $paginate)
    {
        if (isset($description)) {
            $this->options['description'] = $description;
        }

        if (isset($page)) {
            $this->options['page'] = $page;
        }

        if (isset($paginate)) {
            $this->options['paginate'] = $paginate;
        }

        return $this->client->getProductsByDescription($this->options);

    }

    /**
     * Get product by sku
     *
     * @param $sku
     * @return mixed
     */
    public function getBySku($sku)
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

}
