<?php

namespace App\Http\Requests\Api\Authentication;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => ['unique:users,username'],
            'email' => ['email','unique:users,email'],
            'password' => ['min_digits:8'],
            'phone_number' => ['numeric'],
        ];
    }
}
