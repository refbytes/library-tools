<?php

namespace App\Http\Requests;

use App\Enums\ContactType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'vendor_id' => 'required|integer|exists:vendors,id',
            'type' => [
                'required',
                Rule::enum(ContactType::class),
            ],
            'name' => 'required|string|max:255',
            'email' => 'sometimes|email|max:255',
            'phone' => 'sometimes|string|max:255',
            'notes' => 'sometimes|string|max:65535',
            'url' => 'sometimes|string|max:255',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
