<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ListingController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('verified')->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'updateInfo'])->name('profile.info');

    Route::put('/profile', [ProfileController::class, 'updatePassword'])->name('profile.password');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('listings', ListingController::class)->except('index');

//Route for Home
Route::get('/', [ListingController::class, 'index'])->name('home');

require __DIR__ . '/auth.php';
