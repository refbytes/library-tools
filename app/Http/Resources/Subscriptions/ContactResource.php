<?php

namespace App\Http\Resources\Subscriptions;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Subscriptions\Contact */
class ContactResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            /**
             * @var int
             */
            'id' => $this->id,

            'vendor' => new VendorResource($this->whenLoaded('vendor')),

            /**
             * @var string
             */
            'name' => $this->name,

            /**
             * @var string
             */
            'email' => $this->email,

            /**
             * @var string
             */
            'phone' => $this->phone,

            /**
             * @var string
             */
            'notes' => $this->notes,

            /**
             * @var string
             */
            'url' => $this->url,
        ];
    }
}
