<?php

namespace App\Http\Resources\Books;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BookCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->collection->isEmpty()) {
            return [
                'status_code' => 200,
                'status' => 'success',
                'data' => [],
            ];
        }

        return [
            'status_code' => 200,
            'status' => 'success',
            'data' => $this->collection->transform(function ($book) {
                return [
                    'id' => $book->id,
                    'name' => $book->name,
                    'isbn' => $book->isbn,
                    'authors' => explode(',', $book->authors),
                    'number_of_pages' => (int) $book->number_of_pages,
                    'publisher' => $book->publisher,
                    'country' => $book->country,
                    'release_date' => $book->release_date,
                ];
            }),
        ];
    }
}
