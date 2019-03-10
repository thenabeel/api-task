<?php

namespace Tests\Feature\v1\Books;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests wrong resource ID in update book.
     *
     * @return void
     */
    public function testDeleteBookWithWrongResourceId()
    {
        $response = $this->json(
            'DELETE',
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
     * Tests delete book.
     *
     * @param $oldData
     * @return void
     * @dataProvider providerCreateBook
     */
    public function testDeleteBook($oldData)
    {
        // Create a book
        $this->post(
            '/api/v1/books',
            $oldData
        );

        // Update the book
        $response = $this->json(
            'DELETE',
            '/api/v1/books/1'
        );

        $response->assertStatus(204);
    }

    public function providerCreateBook()
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
                    'release_date' => '2002-12-02'
                ],
            ]
        ];
    }
}
