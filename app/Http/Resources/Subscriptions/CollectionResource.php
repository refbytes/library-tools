<?php

namespace App\Http\Resources\Subscriptions;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Subscriptions\Collection */
class CollectionResource extends JsonResource
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
        ];
    }
}
