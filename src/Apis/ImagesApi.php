<?php

namespace src\Apis;

use src\Builders\Images\SearchResultsBuilder;
use src\Clients\HttpClientInterface;
use src\Exceptions\ApiException;

class ImagesApi
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
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

        return (new SearchResultsBuilder($this->client->get($uri)))->build();
    }
}