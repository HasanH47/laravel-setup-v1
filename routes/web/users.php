<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::prefix('users')->name('users.')->group(function () {
//     Route::get('/', [UserController::class, 'index'])->name('index');
//     Route::get('/create', [UserController::class, 'create'])->name('create');
//     Route::post('/create', [UserController::class, 'store'])->name('store');
//     Route::get('/{user}', [UserController::class, 'show'])->name('show');
//     Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
//     Route::patch('/{user}', [UserController::class, 'update'])->name('update');
//     Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
// });

Route::resource('users', UserController::class);
