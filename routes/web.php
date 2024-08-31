<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

//Route::get('/', function () {
//    return view('welcome');
//});

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

Route::get('/auth/redirect', function () {
    return Socialite::driver('saml2')->redirect();
});

Route::post('/auth/callback', function () {
    $user = Socialite::driver('saml2')->stateless()->user();
    dd($user);
});
