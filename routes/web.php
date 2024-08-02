<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\Admin\UserController as AdminUserController;;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Author\PostController as AuthorPostController;
use App\Http\Controllers\Author\AuthController as AuthorAuthController;
use App\Http\Controllers\Author\AuthorController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Public routes (No authentication required)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/test', [PostController::class, 'test']);


// Authentication routes
Auth::routes();


// Protected routes (Only authenticated users can access)
Route::middleware('auth')->group(function() {
    Route::resource('posts', PostController::class);
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});


// Admin routes (Only admin users can access)
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login']);
    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');

    // User management
    Route::resource('users', AdminUserController::class);

    // Post management
    Route::resource('posts', AdminPostController::class);
});


// Author routes (Only author users can access)
Route::prefix('author')->name('author.')->middleware('author')->group(function () {
    Route::get('register', [AuthorAuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [AuthorAuthController::class, 'register']);
    Route::get('login', [AuthorAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthorAuthController::class, 'login']);
    Route::get('dashboard', [AuthorController::class, 'index'])->name('dashboard');

    // Post management
    Route::resource('posts', AuthorPostController::class);
});
