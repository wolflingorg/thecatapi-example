<?php

namespace src\Clients;

use src\Exceptions\ApiException;

interface HttpClientInterface
{
    /**
     * @param  string  $uri
     * @return array|null
     * @throws ApiException
     */
    public function get(string $uri): ?array;

    /**
     * @param  string  $uri
     * @param  array  $data
     * @return array|null
     * @throws ApiException
     */
    public function post(string $uri, array $data = []): ?array;

    /**
     * @param  string  $uri
     * @return array|null
     * @throws ApiException
     */
    public function delete(string $uri): ?array;
}