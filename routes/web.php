<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('signed')
    ->get('invitation/{invitation}/accept', \App\Livewire\AcceptInvitation::class)
    ->name('invitation.accept');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

\Dedoc\Scramble\Scramble::registerUiRoute(path: 'docs/v1', api: 'v1');
\Dedoc\Scramble\Scramble::registerJsonSpecificationRoute(path: 'docs/v1.json', api: 'v1');

Route::get(config('system.subscriptions.path'), \App\Livewire\Subscriptions::class)
    ->name('subscriptions');
