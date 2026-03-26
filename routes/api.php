<?php

use Illuminate\Support\Facades\Route;
use Src\Adapters\Http\Controllers\AuthController;
use Src\Adapters\Http\Controllers\FavoriteController;
use Src\Adapters\Http\Controllers\GifController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('/gifs/search', [GifController::class, 'search']);
    Route::get('/gifs/{id}', [GifController::class, 'show']);

    Route::get('/favorites', [FavoriteController::class, 'index']);
    Route::get('/favorites/{id}', [FavoriteController::class, 'show']);
    Route::post('/favorites', [FavoriteController::class, 'store']);
    Route::delete('/favorites/{id}', [FavoriteController::class, 'destroy']);
});
