<?php

namespace Database\Factories\Subscriptions;

use App\Models\Subscriptions\Proxy;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProxyFactory extends Factory
{
    protected $model = Proxy::class;

    public function definition(): array
    {
        return [
            'name' => 'EZproxy',
            'is_enabled' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
