<?php

namespace Tests\Feature\v1\Books;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests missing parameters in create book.
     *
     * @return void
     */
    public function testCreateBookWithParametersMissing()
    {
        $response = $this->json(
            'POST',
            '/api/v1/books'
        );

        $response->assertStatus(422);
        $response->assertJson([
            'errors' => [
                'name' => [
                    'The name field is required.'
                ]
            ]
        ]);
    }

    /**
     * Tests create book.
     *
     * @param $inputData
     * @param $expectedResponse
     * @return void
     * @dataProvider providerCreateBook
     */
    public function testCreateBook($inputData, $expectedResponse)
    {
        $response = $this->json(
            'POST',
            '/api/v1/books',
            $inputData
        );

        $response->assertStatus(201);
        $response->assertJson($expectedResponse);
    }

    public function providerCreateBook()
    {
        return [
            [
                [
                    'name' => 'Test Book',
                    'isbn' => 'test-isbn',
                    'authors' => 'John Doe,Jane Doe',
                    'number_of_pages' => 500,
                    'publisher' => 'Test Publisher',
                    'country' => 'Test Country',
                    'release_date' => '2002-12-02'
                ],
                [
                    'data' => [
                        'name' => 'Test Book',
                        'isbn' => 'test-isbn',
                        "authors" => [
                            "John Doe",
                            "Jane Doe"
                        ],
                        'number_of_pages' => 500,
                        'publisher' => 'Test Publisher',
                        'country' => 'Test Country',
                        // 'release_date' => '2002-12-02'
                    ],
                ]
            ]
        ];
    }
}
