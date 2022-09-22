<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'name' => 'required|string',
            'isbn' => 'required|string|unique:books,isbn',
            'authors' => 'required',
            'country' => 'required|string',
            'number_of_pages' => 'required|integer',
            'publisher' => 'required|string',
            'release_date' => 'required|date',
        ];

        return $rules;
    }
}
