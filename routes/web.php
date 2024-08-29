<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    // Welcome
    Route::get('/', [HomeController::class, 'index'])->name('welcome');

    // Auth
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginAttempt'])->name('login.attempt');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerAttempt'])->name('register.attempt');
});

Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Users
    require base_path('routes/web/users.php');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
