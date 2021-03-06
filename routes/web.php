<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\Map\Location;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
    // return redirect()->route('dashboard');
});

Route::prefix('dashboard')->middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/users', UserController::class);
    Route::resource('/category', CategoryController::class);
    Route::get('/map', Location::class)->name('map');
    Route::resource('/location', LocationController::class);
});
