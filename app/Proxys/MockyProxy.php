<?php

namespace App\Proxys;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;

class MockyProxy
{
    private const AUTHORIZATION = 'https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6';

    private const NOTIFY = 'http://o4d9z.mocklab.io/notify';
    /**
     * @var
     */
    private $client;

    /**
     *
     */
    public function __construct()
    {
        $this->client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    /**
     * @return mixed
     * @throws GuzzleException
     */
    public function authorization()
    {
        $response = $this->client->post(self::AUTHORIZATION, [
            RequestOptions::HEADERS => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]
        ]);

        $response =  json_decode($response->getBody(), true);

        if ($response == 'authorization') {
            return true;
        }
        return false;

    }

    /**
     * @return mixed
     * @throws GuzzleException
     */
    public function notify()
    {
        $response = $this->client->post(self::NOTIFY, [
            RequestOptions::HEADERS => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]
        ]);

        return json_decode($response->getBody(), true);
    }

}
