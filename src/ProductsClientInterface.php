<?php

namespace JS\Services\Products;

interface ProductsClientInterface
{
    /**
     * Get all categories
     *
     * @return array
     */
    public function getAllCategories();

    /**
     * Get products within a category
     *
     * @params $category_id
     * @params $offset
     * @params $limit
     * @params $query
     * @return array
     */
    public function getProductsByCategory($category_id, $offset, $limit, $query);

    /**
     *
     * Get product by SKU
     *
     * @param $sku
     * @return Response
     */
    public function getProductBySku($sku);

    /**
     * Autocomplete
     *
     * @params $query
     * @params $category_id
     * @return Response
     */
    public function autocomplete($query, $category_id);

}