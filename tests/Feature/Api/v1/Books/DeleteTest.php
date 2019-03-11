<?php

namespace Tests\Feature\Api\v1\Books;

use App\Book;
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
                    'The selected id is invalid.',
                ],
            ],
        ]);
    }

    /**
     * Tests delete book.
     *
     * @param $inputData
     * @param $expectedResponse
     * @return void
     * @dataProvider providerDeleteBook
     */
    public function testDeleteBook($inputData, $expectedResponse)
    {
        // Create a book
        $this->post(
            '/api/v1/books',
            $inputData
        );

        $this->assertEquals(Book::whereId(1)->count(), 1);

        // Delete the book
        $response = $this->json(
            'DELETE',
            '/api/v1/books/1'
        );

        $this->assertEquals(Book::whereId(1)->count(), 0);
        $response->assertStatus(200);
        $response->assertJson($expectedResponse);
    }

    public function providerDeleteBook()
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
                    'status_code' => 204,
                    'status' => 'success',
                    'message' => 'The book Test Name was deleted successfully',
                    'data' => [],
                ],
            ],
        ];
    }
}
