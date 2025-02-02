<?php

use App\Http\Controllers\Api\V1\ProductsController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// public routes
Route::apiResource('products', ProductsController::class)->only(['index', 'show']);

// Logged routes
Route::middleware(['auth:sanctum'])->group(function () {

    // admin routes
    Route::middleware(['role:' . User::ADMIN_ROLE])->group(function () {
        // need to except index/show routes to avoid require login
        Route::apiResource('products', ProductsController::class)->except(['index', 'show']);
    });

    // user routes
    Route::middleware(['role:' . User::USER_ROLE])->group(function () {
        // doesn't need to add products routes here, because they are already added in public routes
    });

});