<?php

namespace src;

use src\Apis\ImagesApi;
use src\Clients\HttpClientInterface;

/**
 * @method ImagesApi images()
 */
class ApiFacade
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function __call($name, $arguments)
    {
        $className = sprintf('src\\Apis\\%sApi', ucfirst($name));

        if (!class_exists($className)) {
            throw new \BadMethodCallException('Wrong api.');
        }

        return new $className($this->client, ...$arguments);
    }
}