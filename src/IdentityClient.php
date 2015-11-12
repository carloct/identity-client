<?php

namespace JS\Services\Identity;

use JS\Services\Identity\Contracts\FactoryInterface;
use GuzzleHttp\Command\Exception\CommandClientException;
use JS\Services\Identity\Exceptions\BadLoginException;

class IdentityClient implements IdentityClientInterface
{
    /**
     * Identity service client
     * @var GuzzleClient
     */
    protected $client;

    /**
     * Constructor
     * @param FactoryInterface $serviceFactory
     */
    public function __construct(FactoryInterface $serviceClientFactory)
    {
        $this->client = $serviceClientFactory->create();
    }

    public function login(array $data)
    {
        try {
            return $this->client->Login($data);
        } catch (CommandClientException $e) {
            $this->handleCommandClientException($e);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getUserData($token)
    {
        try {
            return $this->client->GetUserData(['token' => 'Bearer ' . $token]);
        } catch (CommandClientException $e) {
            $this->handleCommandClientException($e);
        }
    }

    protected function handleCommandClientException(CommandClientException $e)
    {
        $response = $e->getResponse();
        $httpStatusCode = $response->getStatusCode();
        $httpReasonPhrase = $response->getReasonPhrase();
        $httpBody = $response->getBody();
        $httpBodyContents = json_decode($httpBody->getContents(), true);

        switch ($httpStatusCode) {
            case 400:
            case 404:
                $contextDetail = 'Bad request.';
                if (isset($httpBodyContents['detail'])) {
                    $contextDetail = $httpBodyContents['detail'];
                }
                throw new BadLoginException($contextDetail, $httpStatusCode, $e);
                break;
            case 401:
                $contextDetail = 'Bad email and/or password combination.';
                if (isset($httpBodyContents['detail'])) {
                    $contextDetail = $httpBodyContents['detail'];
                }
                throw new BadLoginException($contextDetail, $httpStatusCode, $e);
                break;
            case 403:
                $contextDetail = 'User not owned.';
                if (isset($httpBodyContents['detail'])) {
                    $contextDetail = $httpBodyContents['detail'];
                }
                throw new BadLoginException($contextDetail, $httpStatusCode, $e);
                break;
            default:
                throw $e;
                break;
        }
    }




}
