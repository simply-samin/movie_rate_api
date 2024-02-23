<?php

use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MovieController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('movies', MovieController::class);
    Route::post('/movies/users', [FavoriteController::class, 'create']);
    Route::delete('/movies/users', [FavoriteController::class, 'destroy']);
    Route::get('/movies/{movie}/favorite', [FavoriteController::class, 'isFavorite']);
});


require __DIR__.'/auth_email_verification.php';