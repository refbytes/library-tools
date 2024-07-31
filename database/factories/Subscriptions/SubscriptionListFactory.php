<?php

namespace Database\Factories\Subscriptions;

use App\Models\Subscriptions\SubscriptionList;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class SubscriptionListFactory extends Factory
{
    protected $model = SubscriptionList::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
