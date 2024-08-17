<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Subscriptions\Format */
class FormatResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            /**
             * @var int
             */
            'id' => $this->id,
            /**
             * @var string
             */
            'name' => $this->name,

            'subscriptions' => SubscriptionResource::collection($this->whenLoaded('subscriptions')),
        ];
    }
}
