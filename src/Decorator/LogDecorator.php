<?php

namespace src\Decorator;

use src\Clients\HttpClientInterface;

class LogDecorator implements HttpClientInterface
{
    private HttpClientInterface $client;

    /**
     * TODO set instance of LoggerInterface instead of using file_put_contents
     * @see https://www.php-fig.org/psr/psr-3/
     */
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @inheritDoc
     */
    public function get(string $uri): ?array
    {
        file_put_contents('log.json', sprintf("REQUEST: %s\n", $uri), FILE_APPEND);

        $response = $this->client->get($uri);

        file_put_contents('log.json', sprintf("RESPONSE: %s\n", json_encode($response)), FILE_APPEND);

        return $response;
    }

    /**
     * @inheritDoc
     */
    public function post(string $uri, array $data = []): ?array
    {
        return $this->client->post($uri, $data);
    }

    /**
     * @inheritDoc
     */
    public function delete(string $uri): ?array
    {
        return $this->client->post($uri);
    }
}