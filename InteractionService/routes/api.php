<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\InteractionController;

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

Route::group(['prefix' => 'interactions'], function () {
    Route::get('/', [InteractionController::class, 'index']);
    Route::get('/{id}', [InteractionController::class, 'show']);
    Route::post('/', [InteractionController::class, 'store']);
    Route::put('/{id}', [InteractionController::class, 'update']);
    Route::delete('/{id}', [InteractionController::class, 'destroy']);
});