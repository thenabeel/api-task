<?php

namespace App\Http\Requests\Api\Books;

use Illuminate\Foundation\Http\FormRequest;

class Read extends FormRequest
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
            'filter.release_year' => 'sometimes|integer',
        ];
    }
}
