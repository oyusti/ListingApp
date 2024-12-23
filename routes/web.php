<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

//Route for Home
Route::inertia('/', 'Home')->name('home');

//Route for Register
Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

require __DIR__ . '/auth.php';
