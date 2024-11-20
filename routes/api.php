<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\OrderController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // Products
    Route::apiResource('products', ProductController::class);
    
    // Orders
    Route::apiResource('orders', OrderController::class);
    Route::put('orders/{order}/status', [OrderController::class, 'updateStatus']);
    
    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);
});
