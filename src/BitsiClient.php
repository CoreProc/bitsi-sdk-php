<?php


namespace J6w\Bitsi;

use GuzzleHttp\Client;

class BitsiClient
{

    protected $client;

    public function __construct($apiKey)
    {
        $this->client = new Client([
            'base_url' => 'http://bitsi-web.dev/api/v1/',
            'defaults' => [
                'headers' => ['X-Authorization' => $apiKey]
            ]
        ]);
    }

    public function stations()
    {
        $response = $this->client->get('stations');

        return $response->json();
    }

}