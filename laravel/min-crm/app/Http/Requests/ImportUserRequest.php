<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class importUserRequest extends FormRequest
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
            'file' => 'required|file|max:1024|mimes:xlsx,xls,csv'
        ];
    }

    public function messages(): array {
        return [
            'file.required' => 'Please select a file to upload',
        ];
    }
}