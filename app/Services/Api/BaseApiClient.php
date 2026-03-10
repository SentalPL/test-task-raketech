<?php

namespace App\Services\Api;

use GuzzleHttp\Client;

abstract class BaseApiClient
{
    protected Client $client;
    protected string $baseUrl;

    public function __construct()
    {
        $this->client = new Client();
    }

    protected function get(string $endpoint, array $options = []): array
    {
        $response = $this->client->get($this->baseUrl . $endpoint, $options);

        $countries = json_decode($response->getBody()->getContents(), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception('Invalid JSON response');
        }

        return $countries;
    }
}
