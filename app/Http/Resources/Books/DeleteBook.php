<?php

namespace App\Http\Resources\Books;

use Illuminate\Http\Resources\Json\JsonResource;

class DeleteBook extends JsonResource
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
            'status_code' => 204,
            'status' => __('success'),
            'message' => __('Book deleted successfully', ['name' => $this->oldBookName]),
            'data' => [],
        ];
    }
}
