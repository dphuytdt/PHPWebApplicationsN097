<?php

use App\Http\Controllers\Api\v1\AdminCategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\BookController;
use App\Http\Controllers\Api\v1\AdminBookController;
use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\CommentController;

Route::prefix('books')->group(function () {
    Route::get('is_free', [BookController::class, 'getFreeBook']);
    Route::get('related/{id}', [BookController::class, 'getRelatedBooks']);
    Route::get('homepage', [BookController::class, 'getHomepageBooks']);
    Route::get('read/{id}', [BookController::class, 'readBook']);
    Route::get('view-more/{dataType}', [BookController::class, 'viewMore']);
    Route::get('category/{id}', [BookController::class, 'getBookByCategory']);
    Route::get('/', [BookController::class, 'index']);
    Route::get('/{id}', [BookController::class, 'show']);
    Route::get('search/{keyword}', [BookController::class, 'search']);
});

Route::prefix('category')->group(function () {
    Route::get('/', [CategoryController::class, 'getCategory']);
    Route::get('admin', [CategoryController::class, 'getAllCategoryForAdmin']);
    Route::get('selected', [CategoryController::class, 'getSelectedCategory']);
    Route::get('all', [CategoryController::class, 'getAllCategory']);
});


Route::prefix('admin')->group(function () {
    Route::prefix('books')->group(function () {
        Route::get('/', [AdminBookController::class, 'index']);
        Route::get('/{id}', [AdminBookController::class, 'show']);
        Route::post('/', [AdminBookController::class, 'store']);
        Route::post('delete/{id}', [AdminBookController::class, 'delete']);
        Route::post('/{id}', [AdminBookController::class, 'update']);
    });
    Route::prefix('comments')->group(function () {
        Route::get('/', [CommentController::class, 'getAllComment']);
        Route::get('/{id}', [CommentController::class, 'getComment']);
        Route::post('/', [CommentController::class, 'storeComment']);
        Route::post('/{id}', [CommentController::class, 'updateComment']);
        Route::post('delete/{id}', [CommentController::class, 'deleteComment']);
    });
    Route::prefix('categories')->group(function () {
        Route::post('/', [AdminCategoryController::class, 'store']);
        Route::get('/', [AdminCategoryController::class, 'index']);
        Route::post('/import', [AdminCategoryController::class, 'import']);
        Route::get('/{id}', [AdminCategoryController::class, 'show']);
        Route::post('/{id}', [AdminCategoryController::class, 'update']);
        Route::post('delete/{id}', [AdminCategoryController::class, 'destroy']);
    });
});
