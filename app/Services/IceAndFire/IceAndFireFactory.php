<?php

namespace App\Services\IceAndFire;

use GuzzleHttp\Client;
use App\Services\IceAndFire\Endpoints\Books;

class IceAndFireFactory
{
    const ENDPOINT_BOOKS = 'books';

    /** @var \GuzzleHttp\Client */
    protected static $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        static::$client = $client;
    }

    /**
     * @param string $endpoint
     * @param array $params
     * @return \Illuminate\Http\Resources\Json\ResourceCollection
     * @throws \Exception
     */
    public static function getData(string $endpoint, array $params = []):
        \Illuminate\Http\Resources\Json\ResourceCollection
    {
        switch ($endpoint) {
            case 'books':
                return (new Books(static::$client, $params))->getData();
        }

        throw new \Exception('Invalid endpoint');
    }
}
