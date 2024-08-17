<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Subscriptions\Subscription */
class SubscriptionResource extends JsonResource
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
            'type' => $this->type,
            /**
             * @var bool
             */
            'is_public' => $this->is_public,
            /**
             * @var string
             */
            'is_featured' => $this->is_featured,
            /**
             * @var string
             */
            'name' => $this->name,
            /**
             * @var string
             */
            'alternate_names' => $this->alternate_names,
            /**
             * @var string
             */
            'url' => $this->url,
            /**
             * @var string
             */
            'description' => $this->description,

            'vendor' => new VendorResource($this->whenLoaded('vendor')),

            'providers' => ProviderResource::collection($this->whenLoaded('providers')),

            'formats' => FormatResource::collection($this->whenLoaded('formats')),

            'subjects' => SubjectResource::collection($this->whenLoaded('subjects')),

            'proxy' => new ProxyResource($this->whenLoaded('proxy')),

            /**
             * @var string
             */
            'thumbnail' => $this->getFirstMediaUrl('thumbnail'),

            /**
             * @var string
             */
            'created_at' => $this->created_at,
            /**
             * @var string
             */
            'updated_at' => $this->updated_at,
        ];
    }
}
