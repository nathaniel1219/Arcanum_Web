<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

// 1️⃣ Public login route
Route::post('/login', [AuthController::class, 'login']);

// 2️⃣ Protected routes (require token)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // Example: existing /user route (optional, can keep or remove)
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
