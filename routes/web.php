<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\Admin\UserController as AdminUserController;;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('root');

// Authentication routes
Auth::routes();

// Protected routes (Must be logged in)
Route::middleware('auth')->group(function() {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::resource('posts', PostController::class);
});

// Admin routes
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::resource('users', AdminUserController::class); // User management
});

// Admin & Author routes
Route::prefix('admin')->name('admin.')->middleware('author')->group(function () {
    Route::resource('posts', AdminPostController::class); // Post management
});
