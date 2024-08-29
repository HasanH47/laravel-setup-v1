<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginAttempt'])->name('login.attempt');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerAttempt'])->name('register.attempt');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('home');
    })->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
