<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class UsersImport implements ToModel, WithHeadingRow, WithValidation {

    /**
     * @param array $row
     * @return User
     */
    public function model(array $row): User {
        return new User([
            'fname'    => $row['fname'],
            'lname'    => $row['lname'],
            'email'    => $row['email'],
            'password' => Hash::make($row['email']),
        ]);
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users',
            'fname' => 'required|string',
            'lname' => 'required|string',
        ];
    }
}
