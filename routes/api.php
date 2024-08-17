<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware([
    'auth:sanctum',
])
    ->prefix('v1')
    ->group(function () {
        Route::apiResource('/subscriptions', \App\Http\Controllers\api\v1\SubscriptionController::class);
        Route::apiResource('/lists', \App\Http\Controllers\api\v1\ListController::class);
        Route::apiResource('/subjects', \App\Http\Controllers\api\v1\SubjectController::class);
        Route::apiResource('/formats', \App\Http\Controllers\api\v1\FormatController::class);
        Route::apiResource('/proxies', \App\Http\Controllers\api\v1\ProxyController::class);
        Route::apiResource('/contacts', \App\Http\Controllers\api\v1\ContactController::class);
        Route::apiResource('/providers', \App\Http\Controllers\api\v1\ProviderController::class);
        Route::apiResource('/vendors', \App\Http\Controllers\api\v1\VendorController::class);
        Route::apiResource('/authentications', \App\Http\Controllers\api\v1\AuthenticationController::class)
            ->only(['index', 'show', 'destroy']);
        Route::post('/vendors/{vendor}/authentications', [\App\Http\Controllers\api\v1\AuthenticationController::class, 'storeVendorAuthentication'])
            ->name('vendors.authentications.store');
        Route::post('/subscriptions/{subscription}/authentications', [\App\Http\Controllers\api\v1\AuthenticationController::class, 'storeSubscriptionAuthentication'])
            ->name('subscriptions.authentications.store');
        Route::put('/vendors/{vendor}/authentications/{authentication}', [\App\Http\Controllers\api\v1\AuthenticationController::class, 'update']);
        Route::apiResource('/users', \App\Http\Controllers\api\v1\UserController::class);
    });
