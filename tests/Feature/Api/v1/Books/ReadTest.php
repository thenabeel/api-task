<?php

namespace Tests\Feature\Api\v1\Books;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests read books with no book in records.
     *
     * @return void
     */
    public function testReadBooksWithNoBook()
    {
        $response = $this->json(
            'GET',
            '/api/v1/books'
        );

        $response->assertStatus(200);
        $response->assertJson([
            'data' => [],
        ]);
    }

    /**
     * Tests read books.
     *
     * @param $inputData
     * @param $expectedResponse
     * @return void
     * @dataProvider providerReadBooks
     */
    public function testReadBooks($inputData, $expectedResponse)
    {
        // Create a book
        $this->post(
            '/api/v1/books',
            $inputData
        );

        // Retrieve books
        $response = $this->json(
            'GET',
            '/api/v1/books'
        );

        $response->assertStatus(200);
        $response->assertJson($expectedResponse);
    }

    public function providerReadBooks()
    {
        return [
            'Filter with valid year' => [
                [
                    'name' => 'Test Book',
                    'isbn' => 'test-isbn',
                    'authors' => 'John Doe,Jane Doe',
                    'number_of_pages' => 500,
                    'publisher' => 'Test Publisher',
                    'country' => 'Test Country',
                    'release_date' => '2002-12-02',
                ],
                [
                    'status_code' => 200,
                    'status' =>  'success',
                    'data' => [
                        [
                            'id' => 1,
                            'name' => 'Test Book',
                            'isbn' => 'test-isbn',
                            'authors' => [
                                'John Doe',
                                'Jane Doe',
                            ],
                            'number_of_pages' => 500,
                            'publisher' => 'Test Publisher',
                            'country' => 'Test Country',
                            // 'release_date' => '2002-12-02'
                        ],
                    ],
                ],
            ],
        ];
    }
}
