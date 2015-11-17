<?php

namespace JS\Services\Products\Descriptions;

use GuzzleHttp\Command\Guzzle\Description;

class ProductsDescription
{
    /*
     * Methods available on the remote service
     */
    protected static $operations = [
        'getProducts' => [
            'httpMethod' => 'GET',
            'uri' => '/products/products/{page}/{paginate}',
            'responseModel' => 'getResponseOutput',
            'parameters' => [
                'format' => [
                    'type' => 'string',
                    'location' => 'query'
                ],
                'page' => [
                    'type' => 'string',
                    'location' => 'query'
                ],
                'paginate' => [
                    'type' => 'string',
                    'location' => 'query'
                ]
            ]
        ],
        'getProductsByDescription' => [
            'httpMethod' => 'GET',
            'uri' => '/products/products/{description}',
            'responseModel' => 'getResponseOutput',
            'parameters' => [
                'format' => [
                    'type' => 'string',
                    'location' => 'query'
                ],
                'page' => [
                    'type' => 'string',
                    'location' => 'query'
                ],
                'paginate' => [
                    'type' => 'string',
                    'location' => 'query'
                ],
                'description' => [
                    'type' => 'string',
                    'location' => 'query'
                ]
            ]
        ],
        'getProductBySku' => [
            'httpMethod' => 'GET',
            'uri' => '/products/products/{sku}/{format}',
            'responseModel' => 'getResponseOutput',
            'parameters' => [
                'format' => [
                    'type' => 'string',
                    'location' => 'query'
                ],
                'sku' => [
                    'type' => 'string',
                    'location' => 'uri'
                ]
            ]
        ],
        'getSuggestions' => [
            'httpMethod' => 'GET',
            'uri' => '/products/store/69/category/{category_id}/suggestions',
            'responseModel' => 'getResponseOutput',
            'parameters' => [
                'category_id' => [
                    'type' => 'string',
                    'location' => 'uri'
                ],
                'query' => [
                    'type' => 'string',
                    'location' => 'query'
                ]
            ]
        ],
        'getProductsByCategory' => [
            'httpMethod' => 'GET',
            'uri' => 'store/69/category/{category_id}',
            'responseModel' => 'getResponseOutput',
            'parameters' => [
                'category_id' => [
                    'type' => 'string',
                    'location' => 'uri'
                ],
                'query' => [
                    'type' => 'string',
                    'location' => 'query'
                ],
                'offset' => [
                    'type' => 'string',
                    'location' => 'query'
                ],
                'limit' => [
                    'type' => 'string',
                    'location' => 'query'
                ]
            ]
        ],
        'getAllCategories' => [
            'httpMethod' => 'GET',
            'uri' => 'store/69/all_categories',
            'responseModel' => 'getResponseOutput',
            'parameters' => [
                'format' => [
                    'type' => 'string',
                    'location' => 'query'
                ]
            ]
        ]
    ];

    /*
     * Response objects
     */
    protected static $models = [
        'getResponseOutput' => [
            'type' => 'object',
            'additionalProperties' => [
                'location' => 'json'
            ]
        ]
    ];

    public static function get($baseUrl)
    {

        return new Description([
            'baseUrl' => $baseUrl,
            'apiVersion' => '1.0',
            'operations' => self::$operations,
            'models' => self::$models,
        ]);
    }

}