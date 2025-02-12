<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;

//Profile Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('verified')->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'updateInfo'])->name('profile.info');

    Route::put('/profile', [ProfileController::class, 'updatePassword'])->name('profile.password');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Listing Routes
Route::get('/', [ListingController::class, 'index'])->name('home');
Route::resource('listings', ListingController::class)->except('index');

//Admin Routes
Route::middleware(['auth', 'verified', Admin::class])
    ->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::put('/admin/{user}/role', [AdminController::class, 'role'])->name('admin.role');
});


//Auth Routes
require __DIR__ . '/auth.php';
