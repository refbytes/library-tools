<?php

test('the subscriptions admin panel requires authentication', function () {
    $response = $this->get('/admin');

    $response->assertStatus(302);
});

test('authorized users can access the subscriptions admin panel', function () {
    \Spatie\Permission\Models\Role::create(['name' => 'admin']);
    $user = \App\Models\User::factory()->create();
    $user->assignRole('admin');

    $response = $this->actingAs($user)
        ->get('/admin');

    $response->assertStatus(200);
});
