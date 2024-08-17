<?php

use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;

test('can make an api request to create a subscription', function () {

    $user = User::factory()->create();

    Sanctum::actingAs(
        $user,
        ['create', 'read'],
    );

    $response = $this
        ->actingAs($user, 'sanctum')
        ->postJson('/api/v1/subscriptions', [
            'type' => \App\Enums\SubscriptionType::DATABASE,
            'vendor_id' => \App\Models\Subscriptions\Vendor::create(['name' => 'Vendor'])->id,
            'name' => 'EBSCO',
            'url' => fake()->url,
        ]);

    $response
        ->assertStatus(201)
        ->assertJson(fn (AssertableJson $json) => $json->has('data')
            ->first(fn (AssertableJson $json) => $json->where('name', 'EBSCO')
                ->etc()
            )
        );
});
