<?php

use App\Http\Controllers\InteractionController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProccessController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartController;

Route::group(['middleware' => 'locale'], function() {

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('book-details/{id}' , [BookController::class, 'bookDetails'])->name('bookDetails');

    Route::get('read-book/{id}', [BookController::class, 'readBook'])->name('readBook');

    Route::get('search/{page?}', [BookController::class, 'search'])->name('search');

    Route::get('category/{id}', [BookController::class, 'getBookByCategory'])->name('getBookByCategory');

    Route::get('books/category/{id}', [BookController::class, 'booksByCategory'])->name('booksByCategory');

    Route::get('category', [BookController::class, 'category'])->name('category');

    Route::get('about', [HomeController::class, 'about'])->name('about');

    Route::get('contact', [HomeController::class, 'contact'])->name('contact');

    Route::get('faq', [HomeController::class, 'faq'])->name('faq');

    Route::post('review', [InteractionController::class, 'review'])->name('review');

    Route::post('reply-review', [InteractionController::class, 'replyReview'])->name('replyReview');



    Route::group(['prefix' => 'wishlist'], function () {
        Route::post('add', [CartController::class, 'addToCartFromWishlist'])->name('wishlist.add');
        Route::get('/{id}', [WishlistController::class, 'index'])->name('wishlist.index');
    });

    Route::prefix('auth')->group(function () {
        Route::get('login', [AuthController::class, 'login'])->name('login');
        Route::post('login', [AuthController::class, 'postLogin'])->name('postLogin');
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
        Route::post('register', [AuthController::class, 'postRegister'])->name('postRegister');

        Route::prefix('verify') -> group(function () {
            Route::get('/', [AuthController::class, 'verifyGet'])->name('verify.get');
            Route::get('/', [AuthController::class, 'verifyPost'])->name('verify.get');
        });

        Route::get('forgot-password', [AuthController::class, 'forgotPassword'])->name('forgotPassword');
        Route::post('forgot-password', [AuthController::class, 'postForgotPassword'])->name('postForgotPassword');

        Route::get('input-otp', [AuthController::class, 'inputOtp'])->name('inputOtp');
        Route::post('input-otp', [AuthController::class, 'postInputOtp'])->name('postInputOtp');

        Route::get('reset-password', [AuthController::class, 'resetPassword'])->name('resetPassword');
        Route::post('reset-password', [AuthController::class, 'postResetPassword'])->name('postResetPassword');

        Route::group(['prefix' => 'profile'], function () {
            Route::get('/', [UserController::class, 'profile'])->name('profile');
            Route::post('{id}', [UserController::class, 'postProfile'])->name('profile.update');
        });

        Route::group(['prefix' => 'upgrade'], function () {
            Route::get('/', [UserController::class, 'upgrade'])->name('upgrade');
            Route::post('process', [PaymentController::class, 'payment'])->name('upgradeVip.checkout.VNPay');
        });

        Route::get('vip-benefits', [UserController::class, 'vipBenefits'])->name('vipBenefits');
    });

    Route::group(['prefix' => 'cart'], function () {
        Route::post('add', [CartController::class, 'addToCart'])->name('cart.add');
        Route::post('payment-vnPay', [CartController::class, 'payment'])->name('cart.payment.vnPay');
        Route::post('payment-moMo', [CartController::class, 'paymentMomo'])->name('cart.payment.moMo');
        Route::get('checkout/{id}', [CartController::class, 'checkOut'])->name('cart.checkOut');
        Route::get('{id}', [CartController::class, 'getUserCart'])->name('cart.getUserCart');
    });

    Route::group(['prefix' => 'news'], function () {
        Route::get('/', [NewsController::class, 'index'])->name('news');
        Route::get('view-more', [NewsController::class, 'viewMore'])->name('news.viewMore');
        Route::get('search/{page?}', [NewsController::class, 'searchNews'])->name('news.search');
        Route::get('{id}', [NewsController::class, 'newsDetail'])->name('newsDetail');
    });

    Route::get('view-more/{dataType}', [BookController::class, 'viewMore'])->name('view.more');

    Route::fallback([HomeController::class, 'handleError'])->name('handleError');

    Route::get('thankYou', [HomeController::class, 'thankYou'])->name('thankYou');

    Route::get('change-language/{language}', [LocaleController::class, 'changeLanguage'])->name('changeLanguage');
});

