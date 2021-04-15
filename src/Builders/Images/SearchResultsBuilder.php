<?php

namespace src\Builders\Images;

use Spatie\DataTransferObject\DataTransferObjectError;
use src\Exceptions\ApiBuilderException;
use src\Models\Images\Image;

class SearchResultsBuilder
{
    private ?array $response;

    public function __construct(?array $response)
    {
        $this->response = $response;
    }

    /**
     * @return array
     */
    public function build(): array
    {
        $results = [];

        if (is_null($this->response)) {
            return $results;
        }

        try {
            foreach ($this->response as $image) {
                $results[] = new Image($image);
            }
        } catch (DataTransferObjectError $e) {
            throw new ApiBuilderException('Wrong API response.');
        }

        return $results;
    }
}