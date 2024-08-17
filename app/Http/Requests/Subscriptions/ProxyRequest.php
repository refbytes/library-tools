<?php

namespace App\Http\Requests\Subscriptions;

use Illuminate\Foundation\Http\FormRequest;

class ProxyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'prefix' => 'required|string|max:255',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
