<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\V1\ProviderController;
use App\Http\Controllers\Api\V1\PartnerController;
use  App\Http\Controllers\Api\V1\GameController;
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::middleware('auth:api')->get('/me', [AuthController::class, 'me']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:api')->post('/refresh', [AuthController::class, 'refresh']);

Route::prefix('v1')->group(function () {
    // Route::get('/providers', [ProviderController::class, 'index']);
    // Route::get('/providers/{id}', [ProviderController::class, 'show']);
    // Route::post('/providers', [ProviderController::class, 'store']);
    // Route::put('/providers/{id}', [ProviderController::class, 'update']);
    // Route::delete('/providers/{id}', [ProviderController::class, 'destroy']);

    // Route::get('/partners', [PartnerController::class, 'index']);
    // Route::get('/partners/{id}', [PartnerController::class, 'show']);
    // Route::post('/partners', [PartnerController::class, 'store']);
    // Route::put('/partners/{id}', [PartnerController::class, 'update']);
    // Route::delete('/partners/{id}', [PartnerController::class, 'destroy']);

    Route::apiResource('/providers', ProviderController::class);
    Route::apiResource('/partners', PartnerController::class); 
    Route::apiResource('/games', GameController::class);

});

