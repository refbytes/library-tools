<?php

use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;

test('can make an api request to create a subscription', function () {
    Sanctum::actingAs(
        User::factory()->create(),
        ['create']
    );

    $response = $this->postJson('/api/v1/subscriptions', [
        'type' => \App\Enums\SubscriptionType::DATABASE,
        'vendor_id' => \App\Models\Subscriptions\Vendor::create(['name' => 'Vendor'])->id,
        'name' => 'Sally',
        'url' => fake()->url,
    ]);

    $response
        ->assertStatus(201)
        ->assertJson(fn (AssertableJson $json) => $json->has('data')
            ->first(fn (AssertableJson $json) => $json->where('name', 'Sally')
                ->etc()
            )
        );
});
