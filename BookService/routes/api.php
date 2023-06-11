<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\BookController;
use App\Http\Controllers\Api\v1\AdminBookController;
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

// Path: routes\api.php
Route::prefix('books')->group(function () {
    Route::get('featured', [BookController::class, 'getFeaturedBooks']);
    Route::get('is_free', [BookController::class, 'getFreeBook']);
    Route::get('read/{id}', [BookController::class, 'readBook']);
    Route::get('/', [BookController::class, 'index']);
    Route::get('/{id}', [BookController::class, 'show']);
    Route::get('search/{keyword}', [BookController::class, 'search']);
});

Route::prefix('category')->group(function () {
    Route::get('/', [BookController::class, 'getCategory']);
    Route::get('selected', [BookController::class, 'getSelectedCategory']);
});


Route::prefix('admin/books')->group(function () {
    Route::get('/', [AdminBookController::class, 'index']);
    Route::get('/{id}', [AdminBookController::class, 'show']);
    Route::post('/', [AdminBookController::class, 'store']);
    Route::put('/{id}', [AdminBookController::class, 'update']);
    Route::post('delete/{id}', [AdminBookController::class, 'delete']);
});