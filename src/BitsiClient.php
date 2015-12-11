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

    public function trip($id, array $params)
    {
        $response = $this->client->get("trips/{$id}", [
            'query' => [
                'from'       => $params['from'],
                'to'         => $params['to'],
                'adults'     => $params['adults'],
                'children'   => $params['children'],
                'infants'    => $params['infants']
            ]
        ]);

        return $response->json();
    }

    public function trips(array $params)
    {
        $response = $this->client->get('trips', [
            'query' => [
                'from'       => $params['from'],
                'to'         => $params['to'],
                'departDate' => $params['departDate'],
                'adults'     => $params['adults'],
                'children'   => $params['children'],
                'infants'    => $params['infants'],
                'type'       => $params['type']
            ]
        ]);

        return $response->json();
    }
    
        public function getPopularDestinationTrips(array $stationIds)
    {
        $response = $this->client->get('trips/destination', [
            'query' => [
                'id' => $stationIds
            ]
        ]);

        return $response->json();
    }

    public function getPopularDestinationReturnTrips(array $stationIds)
    {
        $response = $this->client->get('trips/destination/return', [
            'query' => [
                'id' => $stationIds
            ]
        ]);

        return $response->json();
    }

    public function getProvinceStations(array $provinceIds)
    {
        $response = $this->client->get('provinces/stations', [
            'query' => [
                'id' => $provinceIds
            ]
        ]);

        return $response->json();
    }

}
