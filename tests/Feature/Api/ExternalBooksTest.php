<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Handler\MockHandler;
use App\Services\IceAndFire\IceAndFireFactory;

class ExternalBooksTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $apiMock = new MockHandler([
            new Response(
                200,
                [],
                file_get_contents(__DIR__.'/ExternalBooksResponse.json')
            ),
        ]);

        $client = new Client([
            'handler' => HandlerStack::create($apiMock),
        ]);

        $this->instance(IceAndFireFactory::class, new IceAndFireFactory($client));
    }

    /**
     * Tests get books missing parameter response.
     *
     * @return void
     */
    public function testGetBooksNameParameterMissingResponse()
    {
        $response = $this->json(
            'GET',
            '/api/external-books'
        );

        $response->assertStatus(422);
        $response->assertJson([
            'errors' => [
                'name' => [
                    'The name field is required.',
                ],
            ],
        ]);
    }

    /**
     * Tests get books response.
     *
     * @param $expectedResponse
     * @return void
     * @dataProvider providerGetBooksResponse
     */
    public function testGetBooksResponse($expectedResponse)
    {
        $response = $this->json(
            'GET',
            '/api/external-books',
            [
                'name' => 'A Game of Thrones',
            ]
        );

        $response->assertStatus(200);
        $response->assertJson($expectedResponse);
    }

    public function providerGetBooksResponse()
    {
        return [
            [
                [
                    'data' => [
                        [
                            'name' => 'A Game of Thrones',
                            'isbn' => '978-0553103540',
                            'authors' => [
                                'George R. R. Martin',
                                'Foo',
                            ],
                            'number_of_pages' => 694,
                            'publisher' => 'Bantam Books',
                            'country' => 'United States',
                            'release_date' => '1996-08-01',
                        ],
                        [
                            'name' => 'Foo Test Title',
                            'isbn' => '978-0553103540',
                            'authors' => [
                                'George R. R. Martin',
                                'Foo',
                            ],
                            'number_of_pages' => 695,
                            'publisher' => 'Bantam Books',
                            'country' => 'United States',
                            'release_date' => '1996-08-01',
                        ],
                    ],
                ],
            ],
        ];
    }
}
