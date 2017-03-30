<?php

namespace Schiphol\Schiphol;

use Dotenv\Dotenv;
use GuzzleHttp\Client;
use PHPUnit\Framework\Error\Error;

class SchipholPlanes
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var Dotenv
     */
    private $env;

    /**
     * @var string
     */
    private $endpoint = 'https://api.schiphol.nl/public-flights/aircrafttypes';

    public function __construct(Client $client, Dotenv $env)
    {
        $this->client = $client;
        $this->env = $env;
    }

    public function getPlanes()
    {
        $response = $this->client->request('GET', $this->buildEndpoint(), [
            'headers' => [
                'Accept' => 'application/json',
                'ResourceVersion' => 'v1',
            ]
        ]);

        $body = $response->getBody();

        $types = json_decode($body->getContents());

        $planes = [];

        foreach($types->aircraftTypes as $plane) {
            $planes[] = $plane->longDescription;
        }

        return $planes;
    }

    private function buildEndpoint()
    {
        return $this->endpoint . '?app_id=' . getenv('APP_ID') . '&app_key=' . getenv('APP_KEYS') . '&page=0&sort=%2Biatamain';
    }
}