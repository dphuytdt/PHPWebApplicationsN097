<?php

use App\Http\Controllers\Api\v1\CommentController;
use App\Http\Controllers\Api\v1\NewsController;
use App\Http\Controllers\Api\v1\SlideShowController;
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

    Route::prefix('slide-show')->group(function () {
        Route::get('/', [SlideShowController::class, 'index']);
        Route::post('/', [SlideShowController::class, 'store']);
        Route::get('{id}', [SlideShowController::class, 'show']);
        Route::post('{id}', [SlideShowController::class, 'update']);
        Route::post('delete/{id}', [SlideShowController::class, 'delete']);
    });

    Route::prefix('comment')->group(function () {
        Route::get('/', [CommentController::class, 'index']);
        Route::get('latest', [CommentController::class, 'latest']);
        Route::get('{id}', [CommentController::class, 'show']);
        Route::post('{id}', [CommentController::class, 'update']);
        Route::post('delete/{id}', [CommentController::class, 'delete']);
    });
});

Route::prefix('user')->group(function () {
    Route::prefix('news')->group(function () {
        Route::get('/', [NewsController::class, 'userIndex']);
        Route::get('latest', [NewsController::class, 'userLatest']);
        Route::get('search/{keyword}', [NewsController::class, 'search']);
        Route::get('{id}', [NewsController::class, 'newsDetail']);
    });
});

//Route::prefix('comment')->group(function () {
//    Route::post('/', [CommentController::class, 'commentStore']);
//    Route::post('delete', [CommentController::class, 'commentDelete']);
//    Route::post('reply', [CommentController::class, 'replyComment']);
//    Route::put('/{id}', [CommentController::class, 'commentUpdate']);
//});
