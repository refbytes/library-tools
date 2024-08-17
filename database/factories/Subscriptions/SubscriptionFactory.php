<?php

namespace Database\Factories\Subscriptions;

use App\Models\Subscriptions\Subscription;
use App\Models\Subscriptions\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionFactory extends Factory
{
    protected $model = Subscription::class;

    public function definition(): array
    {
        return [
            'type' => \App\Enums\SubscriptionType::DATABASE,
            'vendor_id' => Vendor::factory()->create()->id,
            'name' => $this->faker->company,
            'url' => $this->faker->url,
        ];
    }
}
