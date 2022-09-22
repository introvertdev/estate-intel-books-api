<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookSearchRequest extends FormRequest
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
            'name' => 'string',
            'country' => 'string',
            'publisher' => 'string',
            'release_date' => 'integer|min:' . (date("Y") - 700) . '|max:' . date("Y"),
        ];

        return $rules;
    }
}
