<?php

use App\Http\Controllers\API\MidtransController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\NewsFeedController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\Map\Location;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('dashboard')->middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/users', UserController::class);
    Route::resource('/category', CategoryController::class);
    Route::get('/map', Location::class)->name('map');
    Route::resource('/destination', DestinationController::class);
    Route::resource('/banner', BannerController::class);
    Route::resource('/news', NewsFeedController::class);

    Route::get('transactions/{id}/status/{status}', [TransactionController::class, 'changeStatus'])
        ->name('transactions.changeStatus');
    Route::resource('transactions', TransactionController::class);
});

// Midtrans Related
Route::get('midtrans/success', [MidtransController::class, 'success']);
Route::get('midtrans/unfinish', [MidtransController::class, 'unfinish']);
Route::get('midtrans/error', [MidtransController::class, 'error']);
