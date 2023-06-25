<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartController;
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



Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/book-details/{id}' , [BookController::class, 'bookDetails'])->name('bookDetails');
//search book
Route::get('/search/{page?}', [BookController::class, 'search'])->name('search');

Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

//category
Route::get('/category/{id}', [BookController::class, 'category'])->name('category');


Route::group(['prefix' => 'wishlist'], function () {
    Route::get('/', [WishlistController::class, 'index'])->name('wishlist.index');
});

//route for Auth
Route::prefix('auth')->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'postLogin'])->name('postLogin');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('register', [AuthController::class, 'postRegister'])->name('postRegister');

    Route::prefix('verify') -> group(function () {
        Route::get('/', [AuthController::class, 'verifyGet'])->name('verify.get');
        Route::get('/', [AuthController::class, 'verifyPost'])->name('verify.get');
    });

    // Route::prefix('choose')->group(function () {
    //     Route::get('district', [AuthController::class, 'chooseDistrict'])->name('register.choose.district');
    //     Route::get('ward', [AuthController::class, 'chooseWard'])->name('register.choose.ward');
    // });

    Route::get('forgot-password', [AuthController::class, 'forgotPassword'])->name('forgotPassword');
    Route::post('forgot-password', [AuthController::class, 'postForgotPassword'])->name('postForgotPassword');

    Route::get('input-otp', [AuthController::class, 'inputOtp'])->name('inputOtp');
    Route::post('input-otp', [AuthController::class, 'postInputOtp'])->name('postInputOtp');

    Route::get('reset-password', [AuthController::class, 'resetPassword'])->name('resetPassword');
    Route::post('reset-password', [AuthController::class, 'postResetPassword'])->name('postResetPassword');

    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [UserController::class, 'profile'])->name('profile');
        Route::post('/', [AuthController::class, 'postProfile'])->name('profile.update');
    });

    Route::group(['prefix' => 'cart'], function () {
        Route::get('/', [CartController::class, 'index'])->name('cart.index');
        Route::post('/add', [CartController::class, 'addToCart'])->name('cart.add');
        Route::get('checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    });

    Route::get('upgrade', [UserController::class, 'upgrade'])->name('upgrade');

    Route::post('checkout', [PaymentController::class, 'checkOut'])->name('checkout');

    Route::get('vip-benefits', [UserController::class, 'vipBenefits'])->name('vipBenefits');
});

//404 page
Route::fallback([HomeController::class, 'handleError'])->name('handleError');
