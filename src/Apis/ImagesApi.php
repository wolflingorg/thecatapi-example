<?php

namespace src\Apis;

use src\Exceptions\ApiException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ImagesApi
{
    private Client $client;

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
    public function search(int $limit = 5, int $page = 10, string $order = 'Desc'): array
    {
        $uri = sprintf(
            'https://api.thecatapi.com/v1/images/search?limit=%d&page=%d&order=%s',
            $limit,
            $page,
            $order
        );

        try {
            $result = $this->client->get($uri)->getBody()->getContents();

            return json_decode($result);
        } catch (GuzzleException $e) {
            throw new ApiException($e->getMessage(), $e->getCode());
        }
    }
}