<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/subscriptions', \App\Http\Controllers\SubscriptionController::class);
    Route::apiResource('/lists', \App\Http\Controllers\ListController::class);
    Route::apiResource('/subjects', \App\Http\Controllers\SubjectController::class);
    Route::apiResource('/formats', \App\Http\Controllers\FormatController::class);
    Route::apiResource('/proxies', \App\Http\Controllers\ProxyController::class);
    Route::apiResource('/contacts', \App\Http\Controllers\ContactController::class);
    Route::apiResource('/providers', \App\Http\Controllers\ProviderController::class);
    Route::apiResource('/vendors', \App\Http\Controllers\VendorController::class);
    Route::apiResource('/authentications', \App\Http\Controllers\AuthenticationController::class)
        ->only(['index', 'show', 'destroy']);
    Route::post('/vendors/{vendor}/authentications', [\App\Http\Controllers\AuthenticationController::class, 'storeVendorAuthentication'])
        ->name('vendors.authentications.store');
    Route::post('/subscriptions/{subscription}/authentications', [\App\Http\Controllers\AuthenticationController::class, 'storeSubscriptionAuthentication'])
        ->name('subscriptions.authentications.store');
    Route::put('/vendors/{vendor}/authentications/{authentication}', [\App\Http\Controllers\AuthenticationController::class, 'update']);
});
