<?php

namespace src\Apis;

use GuzzleHttp\Client;

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
     */
    public function search(int $limit = 5, int $page = 10, string $order = 'Desc')
    {
        $uri = sprintf(
            'https://api.thecatapi.com/v1/images/search?limit=%d&page=%d&order=%s',
            $limit,
            $page,
            $order
        );

        $result = $this->client->get($uri)->getBody()->getContents();

        return json_decode($result);
    }
}