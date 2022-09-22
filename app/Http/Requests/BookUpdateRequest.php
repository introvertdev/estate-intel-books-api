<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookUpdateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'name' => 'sometimes|required|string',
            'isbn' => 'sometimes|required|string|unique:books',
            'authors' => 'sometimes|required|string',
            'country' => 'sometimes|required|string',
            'number_of_pages' => 'sometimes|required|integer',
            'publisher' => 'sometimes|required|string',
            'release_date' => 'sometimes|required|date',
        ];

        return $rules;
    }
}
