<?php

namespace App\Http\Resources\Subscriptions;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Subscriptions\Authentication */
class AuthenticationResource extends JsonResource
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
             * @var string
             */
            'name' => $this->name,
            /**
             * @var string
             */
            'url' => $this->url,
            /**
             * @var string
             */
            'username' => $this->username,
            /**
             * @var string
             */
            'password' => $this->password,
        ];
    }
}
