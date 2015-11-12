<?php

namespace JS\Services\Identity\Descriptions;

use GuzzleHttp\Command\Guzzle\Description;

class IdentityDescription
{
    /*
     * Methods available on the remote service
     */
    protected static $operations = [
        'Login' => [
            'httpMethod' => 'POST',
            'uri' => 'tokens/',
            'responseModel' => 'getAuth',
            'parameters' => [
                'grant_type' => [
                    'location' => 'postField',
                    'required' => true,
                    'type'     => 'string'
                ],
                'username' => [
                    'location' => 'postField',
                    'required' => true,
                    'type'     => 'string'
                ],
                'password' => [
                    'location' => 'postField',
                    'required' => true,
                    'type'     => 'string'
                ],
            ],
        ],
        'GetUserData' => [
            'httpMethod' => 'GET',
            'uri' => 'users/me/',
            'responseModel' => 'getAuth',
            'parameters' => [
                'token' => [
                    'type'     => 'string',
                    'location' => 'header',
                    'sentAs'   => 'Authorization',
                    'required' => true
                ]
            ]
        ],
    ];

    /*
     * Response objects
     */
    protected static $models = [
        'getAuth' => [
            'type' => 'object',
            'additionalProperties' => [
                'location' => 'json'
            ]
        ]
    ];

    public static function get($baseUrl)
    {
        return new Description([
            'baseUrl'    => $baseUrl,
            'operations' => self::$operations,
            'models'     => self::$models,
        ]);
    }
}