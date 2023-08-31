<?php

use App\Http\Controllers\NewsController;
use App\Http\Controllers\SystemController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SlideShowController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CommentController;
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
    Route::get('logout', [AuthController::class, 'logout'])->name('adminLogout');
    Route::get('request-reset-password', [AuthController::class, 'requestResetPassword'])->name('requestResetPassword');
    Route::post('request-reset-password', [AuthController::class, 'postRequestResetPassword'])->name('postRequestResetPassword');
});

Route::group(['middleware' => 'check.auth'] , function(){
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::group(['prefix' => 'category'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('category.index');
        Route::get('create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::post('update/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::post('delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
    });
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('create', [UserController::class, 'create'])->name('users.create');
        Route::post('store', [UserController::class, 'store'])->name('users.store');
        Route::post('import', [UserController::class, 'import'])->name('users.import');
        Route::get('edit/{id}', [UserController::class, 'edit'])->name('users.edit');
        Route::post('update/{id}', [UserController::class, 'update'])->name('users.update');
        Route::get('delete/{id}', [UserController::class, 'deleteUser'])->name('users.delete');
    });
    Route::group(['prefix' => 'slides'], function () {
        Route::get('/', [SlideShowController::class, 'index'])->name('slides.index');
        Route::get('create', [SlideShowController::class, 'create'])->name('slides.create');
        Route::post('store', [SlideShowController::class, 'store'])->name('slides.store');
        Route::get('edit/{id}', [SlideShowController::class, 'edit'])->name('slides.edit');
        Route::post('update/{id}', [SlideShowController::class, 'update'])->name('slides.update');
        Route::get('delete/{id}', [SlideShowController::class, 'delete'])->name('slides.delete');
    });
    Route::group(['prefix' => 'books'], function () {
        Route::get('/', [BookController::class, 'index'])->name('books.index');
        Route::get('create', [BookController::class, 'create'])->name('books.create');
        Route::post('store', [BookController::class, 'store'])->name('books.store');
        Route::post('import', [BookController::class, 'import'])->name('books.import');
        Route::get('edit/{id}', [BookController::class, 'edit'])->name('books.edit');
        Route::post('update/{id}', [BookController::class, 'update'])->name('books.update');
        Route::get('delete/{id}', [BookController::class, 'delete'])->name('books.delete');
    });
    Route::group(['prefix' => 'comments'], function () {
        Route::get('/', [CommentController::class, 'index'])->name('comments.index');
        Route::get('create', [CommentController::class, 'create'])->name('comments.create');
        Route::post('store', [CommentController::class, 'store'])->name('comments.store');
        Route::get('edit/{id}', [CommentController::class, 'edit'])->name('comments.edit');
        Route::post('update/{id}', [CommentController::class, 'update'])->name('comments.update');
        Route::get('delete/{id}', [CommentController::class, 'delete'])->name('comments.delete');
    });
    Route::group(['prefix' => 'news'], function () {
        Route::get('/', [NewsController::class, 'index'])->name('news.index');
        Route::get('create', [NewsController::class, 'create'])->name('news.create');
        Route::post('store', [NewsController::class, 'store'])->name('news.store');
        Route::post('import', [NewsController::class, 'import'])->name('news.import');
        Route::post('update/{id}', [NewsController::class, 'update'])->name('news.update');
        Route::post('delete/{id}', [NewsController::class, 'delete'])->name('news.delete');

    });

    Route::get('get-billing', [SystemController::class, 'getBilling'])->name('getBilling');
    Route::get('export-statistical', [SystemController::class, 'exportStatistical'])->name('exportStatistical');

    Route::get('profile/{id}', [UserController::class, 'profile'])->name('profile');
    Route::get('setting', [SystemController::class, 'setting'])->name('setting');
    Route::get('check-log', [SystemController::class, 'checkLog'])->name('checkLog');
    Route::fallback([HomeController::class, 'handleError'])->name('handleError');
});


