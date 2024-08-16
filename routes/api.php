<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/subscriptions', \App\Http\Controllers\SubscriptionController::class)
    ->middleware('auth:sanctum');
