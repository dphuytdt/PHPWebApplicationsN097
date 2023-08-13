<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\BookController;
use App\Http\Controllers\Api\v1\AdminBookController;
use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\CommentController;
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
    Route::get('is_free', [BookController::class, 'getFreeBook']);
    Route::get('homepage', [BookController::class, 'getHomepageBooks']);
    Route::get('read/{id}', [BookController::class, 'readBook']);
    Route::get('view-more/{dataType}', [BookController::class, 'viewMore']);
    Route::get('/', [BookController::class, 'index']);
    Route::get('/{id}', [BookController::class, 'show']);
    Route::get('search/{keyword}', [BookController::class, 'search']);
});

Route::prefix('category')->group(function () {
    Route::get('/', [CategoryController::class, 'getCategory']);
    Route::get('admin', [CategoryController::class, 'getAllCategoryForAdmin']);
    Route::get('selected', [CategoryController::class, 'getSelectedCategory']);
});


Route::prefix('admin')->group(function () {
    Route::prefix('books')->group(function () {
        Route::get('/', [AdminBookController::class, 'index']);
        Route::get('/{id}', [AdminBookController::class, 'show']);
        Route::post('/', [AdminBookController::class, 'store']);
        Route::put('/{id}', [AdminBookController::class, 'update']);
        Route::post('delete/{id}', [AdminBookController::class, 'delete']);
    });
    Route::prefix('comments')->group(function () {
        Route::get('/', [CommentController::class, 'getAllComment']);
        Route::get('/{id}', [CommentController::class, 'getComment']);
        Route::post('/', [CommentController::class, 'storeComment']);
        Route::put('/{id}', [CommentController::class, 'updateComment']);
        Route::post('delete/{id}', [CommentController::class, 'deleteComment']);
    });
});
