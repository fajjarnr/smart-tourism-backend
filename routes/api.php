<?php

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\LocationController;
use App\Http\Controllers\API\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [UserController::class, 'fetch']);
    Route::post('user', [UserController::class, 'updateProfile']);
    Route::post('user/photo', [UserController::class, 'updatePhoto']);
    Route::get('transaction', [TransactionController::class, 'all']);
    Route::post('transaction/{id}', [TransactionController::class, 'update']);
    Route::post('checkout', [TransactionController::class, 'checkout']);
    Route::post('logout', [UserController::class, 'logout']);
});

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);

Route::get('/category', [CategoryController::class, 'fetch']);
Route::get('/location', [LocationController::class, 'all']);
Route::get('/location/{category_id}', [LocationController::class, 'fetch']);

Route::post('midtrans/callback', [MidtransController::class, 'callback']);
