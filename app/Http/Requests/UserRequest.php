<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email:rfc,dns|max:255',
            'password' => 'sometimes|string|max:255',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
