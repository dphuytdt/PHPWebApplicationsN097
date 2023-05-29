<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
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


// Route::group(['middleware' => 'check.auth'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    // Route::get('/books' , [BookController::class, 'index'])->name('books');
    Route::get('/book-details/{id}' , [BookController::class, 'show'])->name('bookDetails');
    //search book
    Route::get('/search', [BookController::class, 'search'])->name('search');

    Route::get('/about', [HomeController::class, 'about'])->name('about');

    Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
    //404
    // Route::any('{catchall}', [HomeController::class, 'notFound'])->where('catchall', '.*');
// });

//route for Auth
Route::prefix('auth')->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'postLogin'])->name('postLogin');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('register', [AuthController::class, 'postRegister'])->name('postRegister');

    Route::prefix('choose')->group(function () {
        Route::get('district', [AuthController::class, 'chooseDistrict'])->name('register.choose.district');
        Route::get('ward', [AuthController::class, 'chooseWard'])->name('register.choose.ward');
    });

    Route::get('forgot-password', [AuthController::class, 'forgotPassword'])->name('forgotPassword');
    Route::post('forgot-password', [AuthController::class, 'postForgotPassword'])->name('postForgotPassword');

    Route::get('input-otp', [AuthController::class, 'inputOtp'])->name('inputOtp');
    Route::post('input-otp', [AuthController::class, 'postInputOtp'])->name('postInputOtp');
});