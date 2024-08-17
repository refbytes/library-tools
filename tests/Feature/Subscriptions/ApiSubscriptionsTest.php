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
    $subscription = \App\Models\Subscriptions\Subscription::factory()->make();
    $response = $this
        ->actingAs($user, 'sanctum')
        ->postJson('/api/v1/subscriptions', $subscription->toArray());

    $response
        ->assertStatus(201)
        ->assertJson(fn (AssertableJson $json) => $json->has('data')
            ->first(fn (AssertableJson $json) => $json->where('name', $subscription->name)
                ->etc()
            )
        );
});
