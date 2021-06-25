<?php

use App\Http\Controllers\API\BannerController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\DestinationController;
use App\Http\Controllers\API\LocationController;
use App\Http\Controllers\API\MidtransController;
use App\Http\Controllers\API\NewsFeedController;
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

// Route::get('all-user', [UserController::class, 'all']);

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);

Route::get('category', [CategoryController::class, 'fetch']);
Route::get('destination', [DestinationController::class, 'all']);
Route::get('destination/query', [DestinationController::class, 'query']);
Route::get('destination/{category_id}', [DestinationController::class, 'fetch']);

Route::get('location', [LocationController::class, 'all']);
Route::get('location/{category_id}', [LocationController::class, 'fetch']);

Route::get('news', [NewsFeedController::class, 'all']);
Route::get('banner', [BannerController::class, 'all']);

Route::post('midtrans/callback', [MidtransController::class, 'callback']);
