<?php

namespace Tests\Feature\v1\Books;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests wrong resource ID in show book.
     *
     * @return void
     */
    public function testShowBookWithWrongResourceId()
    {
        $response = $this->json(
            'GET',
            '/api/v1/books/3'
        );

        $response->assertStatus(422);
        $response->assertJson([
            'errors' => [
                'id' => [
                    'The selected id is invalid.',
                ],
            ],
        ]);
    }

    /**
     * Tests show book.
     *
     * @param $inputData
     * @param $expectedResponse
     * @return void
     * @dataProvider providerShowBook
     */
    public function testShowBook($inputData, $expectedResponse)
    {
        // Create a book
        $this->post(
            '/api/v1/books',
            $inputData
        );

        // Update the book
        $response = $this->json(
            'GET',
            '/api/v1/books/1'
        );

        $response->assertStatus(200);
        $response->assertJson($expectedResponse);
    }

    public function providerShowBook()
    {
        return [
            [
                [
                    'name' => 'Test Name',
                    'isbn' => 'test-isbn',
                    'authors' => 'John Doe,Jane Doe',
                    'number_of_pages' => 500,
                    'publisher' => 'Test Publisher',
                    'country' => 'Test Country',
                    'release_date' => '2002-12-02',
                ],
                [
                    'data' => [
                        'name' => 'Test Name',
                        'isbn' => 'test-isbn',
                        'authors' => [
                            'John Doe',
                            'Jane Doe',
                        ],
                        'number_of_pages' => 500,
                        'publisher' => 'Test Publisher',
                        'country' => 'Test Country',
                    ],
                ],
            ],
        ];
    }
}
