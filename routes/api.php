<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [UserController::class, 'index']);
});
