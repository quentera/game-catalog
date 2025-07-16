<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::middleware('auth:api')->get('/me', [AuthController::class, 'me']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:api')->post('/refresh', [AuthController::class, 'refresh']);
