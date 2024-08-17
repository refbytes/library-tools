<?php

namespace App\Http\Requests\Subscriptions;

use App\Enums\SubscriptionType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubscriptionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'is_public' => 'sometimes|boolean',
            'is_featured' => 'sometimes|boolean',
            'type' => [
                'required',
                Rule::enum(SubscriptionType::class),
            ],
            'name' => 'required|string|max:255',
            'alternate_names' => 'sometimes|string|max:255',
            'url' => 'required|url|max:255',
            'description' => 'sometimes|string|max:65535',
            'authenticated_description' => 'sometimes|string|max:65535',
            'internal_notes' => 'sometimes|string|max:65535',
            'vendor_id' => 'required|integer|exists:vendors,id',
            'proxy_id' => 'sometimes|integer|exists:proxies,id',
            /**
             * @ignoreParam
             */
            'thumbnail' => 'sometimes|image|max:2048',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
