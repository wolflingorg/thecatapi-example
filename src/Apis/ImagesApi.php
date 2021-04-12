<?php

namespace src\Apis;

use GuzzleHttp\Client;
use src\Exceptions\ApiException;
use GuzzleHttp\Exception\GuzzleException;

class ImagesApi
{
    private Client $client;

    /**
     * TODO replace Client with custom interface HttpClientInterface with only one method "get" and create Adapter for Guzzle
     * @see https://refactoring.guru/design-patterns/adapter
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param  int  $limit
     * @param  int  $page
     * @param  string  $order
     * @return array
     * @throws ApiException
     */
    public function search(int $limit = 5, int $page = 10, string $order = 'Desc'): ?array
    {
        $uri = sprintf(
            'https://api.thecatapi.com/v1/images/search?limit=%d&page=%d&order=%s',
            $limit,
            $page,
            $order
        );

        try {
            $result = $this->client->get($uri)->getBody()->getContents();

            // TODO return specific model (ie Image) instead of raw array
            return json_decode($result);
        } catch (GuzzleException $e) {
            throw new ApiException($e->getMessage(), $e->getCode());
        }
    }
}