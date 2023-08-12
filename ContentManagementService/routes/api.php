<?php

use App\Http\Controllers\Api\v1\NewsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('admin')->group(function () {
    Route::prefix('news')->group(function () {
        Route::get('/', [NewsController::class, 'index']);
        Route::post('/', [NewsController::class, 'store']);
        Route::get('latest', [NewsController::class, 'latest']);
        Route::get('{id}', [NewsController::class, 'show']);
        Route::post('/{id}', [NewsController::class, 'update']);
        Route::post('delete/{id}', [NewsController::class, 'delete']);
    });
});

Route::prefix('user')->group(function () {
    Route::prefix('news')->group(function () {
        Route::get('/', [NewsController::class, 'userIndex']);
        Route::get('/latest', [NewsController::class, 'userLatest']);
        Route::get('/{id}', [NewsController::class, 'userShow']);
    });
});
