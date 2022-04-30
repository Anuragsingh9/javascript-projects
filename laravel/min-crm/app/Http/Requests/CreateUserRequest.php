<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array {
        return [
            'user'         => 'required|array',
            'user.*.fname' => 'required|string',
            'user.*.lname' => 'required|string',
            'user.*.email' => 'required|email|unique:users,email',
        ];
    }
}
