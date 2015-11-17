<?php

namespace JS\Services\Products;

interface ProductsClientInterface
{
    /**
     *
     * Fetch a list of products, can be paginated
     *
     * @param $page
     * @param $paginate
     * @return Response
     */
    public function getAll($page, $paginate);

    /**
     *
     * Search for products by description, can be paginated
     *
     * @param $page
     * @param $paginate
     * @return Response
     */
    public function getByDescription($description, $page, $paginate);

    /**
     *
     * Get product by SKU
     *
     * @param $sku
     * @return Response
     */
    public function getBySku($sku);

    /**
     * Autocomplete
     *
     * @params $query
     * @params $category_id
     * @return Response
     */
    public function autocomplete($query, $category_id);

    /**
     * Get all categories
     *
     * @return array
     */
    public function getAllCategories();
}