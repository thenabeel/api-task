<?php

namespace App\Http\Resources\Books;

use Illuminate\Http\Resources\Json\JsonResource;

class CreateBook extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'status_code' => 201,
            'status' => __('success'),
            'data' => [
                'name' => $this->name,
                'isbn' => $this->isbn,
                'authors' => explode(',', $this->authors),
                'number_of_pages' => (int) $this->number_of_pages,
                'publisher' => $this->publisher,
                'country' => $this->country,
                'release_data' => $this->release_date,
            ],
        ];
    }
}
