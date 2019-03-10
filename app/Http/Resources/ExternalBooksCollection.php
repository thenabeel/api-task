<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ExternalBooksCollection extends ResourceCollection
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
                    'name' => $book->name,
                    'isbn' => $book->isbn,
                    'authors' => $book->authors,
                    'number_of_pages' => (int) $book->numberOfPages,
                    'publisher' => $book->publisher,
                    'country' => $book->country,
                    'release_date' => Carbon::parse($book->released)->format('Y-m-d'),
                ];
            }),
        ];
    }
}
