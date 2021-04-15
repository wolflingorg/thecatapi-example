<?php

namespace src\Clients;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use src\Exceptions\ApiHttpClientException;

/**
 * @link https://refactoring.guru/design-patterns/adapter
 */
class GuzzleAdapter implements HttpClientInterface
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @inheritDoc
     */
    public function get(string $uri): ?array
    {
        try {
            return json_decode($this->client->get($uri)->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            throw new ApiHttpClientException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @inheritDoc
     */
    public function post(string $uri, array $data = []): ?array
    {
        throw new \BadMethodCallException('Should not be called');
    }

    /**
     * @inheritDoc
     */
    public function delete(string $uri): ?array
    {
        throw new \BadMethodCallException('Should not be called');
    }
}