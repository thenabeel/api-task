<?php

namespace App\Services\IceAndFire\Endpoints;

use GuzzleHttp\Client;
use App\Services\IceAndFire\ServiceInterface;
use App\Http\Resources\ExternalBooksCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;

class Books implements ServiceInterface
{
    const ENDPOINT = 'books';

    /** @var \GuzzleHttp\Client */
    protected $client;

    /** @var array */
    protected $params;

    /**
     * Books constructor.
     * @param Client $client
     * @param array $params
     */
    public function __construct(Client $client, array $params = [])
    {
        $this->client = $client;
        $this->params = $params;
    }

    /**
     * @return ResourceCollection
     */
    public function getData(): ResourceCollection
    {
        $data = $this->doRequest(static::ENDPOINT, $this->params);

        return new ExternalBooksCollection(collect(json_decode($data)));
    }

    /**
     * @param string $endpoint
     * @param array $queryParams
     * @return string
     */
    protected function doRequest(string $endpoint, array $queryParams): string
    {
        $data = $this->client->get(
            $endpoint,
            [
                'query' => $queryParams,
            ]
        );

        return $data->getBody()->getContents();
    }
}
