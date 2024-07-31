<?php

namespace Database\Factories\Subscriptions;

use App\Models\Subscriptions\Authentication;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AuthenticationFactory extends Factory
{
    protected $model = Authentication::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
