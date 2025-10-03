<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductApiController;

// Public login and register route
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Protected routes (require token)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // Example: existing /user route (optional, can keep or remove)
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Product APIs
    Route::get('/products', [ProductApiController::class, 'index']);
    Route::get('/products/pokemon', [ProductApiController::class, 'pokemon']);
    Route::get('/products/ygo', [ProductApiController::class, 'ygo']);
    Route::get('/products/funko', [ProductApiController::class, 'funko']);
    Route::get('/products/{id}', [ProductApiController::class, 'show']);
});


