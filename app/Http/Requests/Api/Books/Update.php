<?php

namespace App\Http\Requests\Api\Books;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|exists:books',
            'name' => 'sometimes|string',
            'isbn' => 'sometimes|string',
            'authors' => 'sometimes|string',
            'number_of_pages' => 'sometimes|integer',
            'publisher' => 'sometimes|string',
            'country' => 'sometimes|string',
            'release_date' => 'sometimes|date_format:Y-m-d',
        ];
    }

    protected function validationData()
    {
        return array_merge($this->request->all(), [
            'id' => $this->route('id')
        ]);
    }
}
