<?php

namespace App\Http\Requests\Authentication;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    public function rules(): array
    {
        return [
            'username' => 'unique:users',
            'email' => 'required | email | unique:users,email',
            'password' => 'required | min_digits: 8'
        ];
    }
}
