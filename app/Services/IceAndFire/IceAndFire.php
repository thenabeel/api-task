<?php

namespace App\Services\IceAndFire;

use App\Http\Resources\ExternalBooksCollection;
use GuzzleHttp\Client;

class IceAndFire
{
    const ENDPOINT_BOOKS = 'books';

    /** @var \GuzzleHttp\Client */
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getBooks($name)
    {
        $queryParams = [
            'name' => $name
        ];

//        $data = $this->doRequest(static::ENDPOINT_BOOKS, $queryParams);

        $data = '[{"url":"https://www.anapioficeandfire.com/api/books/1","name":"A Game offf Thrones","isbn":"978-0553103540","authors":["George R. R. Martin", "Foo"],"numberOfPages":694,"publisher":"Bantam Books","country":"United States","mediaType":"Hardcover","released":"1996-08-01T00:00:00"},{"url":"https://www.anapioficeandfire.com/api/books/1","name":"A Game of Thrones","isbn":"978-0553103540","authors":["George R. R. Martin"],"numberOfPages":694,"publisher":"Bantam Books","country":"United States","mediaType":"Hardcover","released":"1996-08-01T00:00:00"}]';
        return new ExternalBooksCollection(collect(json_decode($data)));
    }

    protected function doRequest($endpoint, $queryParams)
    {
        $data = $this->client->get(
            $endpoint,
            [
                'query' => $queryParams
            ]
        );

        return $data->getBody()->getContents();
    }
}
