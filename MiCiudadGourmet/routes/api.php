<?php

use App\Http\Controllers\Api\RestaurantController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ReviewController;

// Endpoints públicos
Route::apiResource('restaurants', RestaurantController::class)
     ->only(['index', 'show']);

// Endpoints protegidos
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('restaurants', RestaurantController::class)
         ->only(['store', 'update', 'destroy']);
    // CRUD de reseñas (crear, actualizar, eliminar)
    Route::post('restaurants/{restaurant}/reviews',  [ReviewController::class, 'store']);
    Route::put('restaurants/{restaurant}/reviews/{review}', [ReviewController::class, 'update']);
    Route::delete('restaurants/{restaurant}/reviews/{review}', [ReviewController::class, 'destroy']);

    // Favoritos
    Route::post('restaurants/{restaurant}/favorite',  [RestaurantController::class, 'favorite']);
    Route::delete('restaurants/{restaurant}/favorite', [RestaurantController::class, 'unfavorite']);

});

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login',    [AuthController::class, 'login']);
    Route::post('logout',   [AuthController::class, 'logout'])->middleware('auth:sanctum');
});

Route::get('restaurants/{restaurant}/reviews', [ReviewController::class, 'index']);
Route::get('restaurants/{restaurant}/reviews/{review}', [ReviewController::class, 'show']);
