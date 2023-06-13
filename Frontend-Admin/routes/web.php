<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SlideShowController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::prefix('auth')->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'postLogin'])->name('postLogin');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::group(['middleware' => 'check.auth'] , function(){
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::group(['prefix' => 'category'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('category.index');
        Route::get('create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::post('update/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
    });
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('create', [UserController::class, 'create'])->name('users.create');
        Route::post('store', [UserController::class, 'store'])->name('users.store');
        Route::get('edit/{id}', [UserController::class, 'edit'])->name('users.edit');
        Route::post('update/{id}', [UserController::class, 'update'])->name('users.update');
        Route::get('delete/{id}', [UserController::class, 'delete'])->name('users.delete');
    }); 
    Route::group(['prefix' => 'slides'], function () {
        Route::get('/', [SlideShowController::class, 'index'])->name('slides.index');
        Route::get('create', [SlideShowController::class, 'create'])->name('slides.create');
        Route::post('store', [SlideShowController::class, 'store'])->name('slides.store');
        Route::get('edit/{id}', [SlideShowController::class, 'edit'])->name('slides.edit');
        Route::post('update/{id}', [SlideShowController::class, 'update'])->name('slides.update');
        Route::get('delete/{id}', [SlideShowController::class, 'delete'])->name('slides.delete');
    });
    Route::fallback([HomeController::class, 'handleError'])->name('handleError');
});


