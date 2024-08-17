<?php

namespace App\Http\Requests\Subscriptions;

use App\Enums\AuthenticationType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProviderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'type' => [
                'required',
                Rule::enum(AuthenticationType::class),
            ],
            'name' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
