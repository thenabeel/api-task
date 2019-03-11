<?php

namespace App\Http\Resources\Books;

use Illuminate\Http\Resources\Json\JsonResource;

class UpdateBook extends JsonResource
{
    protected $oldBookName;

    /**
     * Create a new resource instance.
     *
     * @param  mixed $resource
     * @param $oldBookName
     */
    public function __construct($resource, $oldBookName)
    {
        parent::__construct($resource);
        $this->oldBookName = $oldBookName;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'status_code' => 200,
            'status' => __('success'),
            'message' => __('Book updated successfully', ['name' => $this->oldBookName]),
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
