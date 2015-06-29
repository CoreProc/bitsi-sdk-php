<?php


namespace J6w\Bitsi;

use GuzzleHttp\Client;

class BitsiClient
{

    protected $client;

    public function __construct($apiKey, $baseUrl = null)
    {
        $this->client = new Client([
            'base_url' => $baseUrl ?: 'http://dev.bitsi.coreproc.com/api/v1/',
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

    public function destinations($stationId)
    {
       $response = $this->client->get("stations/{$stationId}/to");

        return $response->json();
    }

    public function trips($params)
    {
        $response = $this->client->get('trips', [
            'query' => [
                'from_station_id' => $params['from_station_id'],
                'to_station_id'   => $params['to_station_id'],
                'departure_date'  => $params['departure_date'],
                'passenger_count' => $params['passenger_count'],
                'children_count'  => $params['children_count'],
                'infant_count'    => $params['infant_count'],
                'is_return'       => isset($params['is_return']) ? $params['is_return'] : false,
            ]
        ]);

        return $response->json();
    }

}