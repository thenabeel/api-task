<?php

namespace Tests\Feature\v1\Books;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests wrong resource ID in update book.
     *
     * @return void
     */
    public function testUpdateBookWithWrongResourceId()
    {
        $response = $this->json(
            'PATCH',
            '/api/v1/books/3'
        );

        $response->assertStatus(422);
        $response->assertJson([
            'errors' => [
                'id' => [
                    'The selected id is invalid.'
                ]
            ]
        ]);
    }

    /**
     * Tests update book.
     *
     * @param $oldData
     * @param $newData
     * @param $expectedResponse
     * @return void
     * @dataProvider providerCreateBook
     */
    public function testUpdateBook($oldData, $newData, $expectedResponse)
    {
        // Create a book
        $this->post(
            '/api/v1/books',
            $oldData
        );

        // Update the book
        $response = $this->json(
            'PATCH',
            '/api/v1/books/1',
            $newData
        );

        $response->assertStatus(200);
        $response->assertJson($expectedResponse);
    }

    public function providerCreateBook()
    {
        return [
            [
                [
                    'name' => 'Old Name',
                    'isbn' => 'test-isbn',
                    'authors' => 'John Doe,Jane Doe',
                    'number_of_pages' => 500,
                    'publisher' => 'Test Publisher',
                    'country' => 'Test Country',
                    'release_date' => '2002-12-02'
                ],
                [
                    'name' => 'New Name',
                ],
                [
                    'data' => [
                        'name' => 'New Name',
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
