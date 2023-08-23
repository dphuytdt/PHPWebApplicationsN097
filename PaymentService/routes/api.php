<?php

use App\Http\Controllers\Api\v1\OrderHistoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\CartController;
use App\Http\Controllers\Api\v1\WishlistController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('cart')->group(function () {
    Route::post('add', [CartController::class, 'add']);
    Route::post('delete', [CartController::class, 'deleteCart']);
    Route::post('checkout', [CartController::class, 'checkout']);
    Route::get('get/{userID}', [CartController::class, 'getCart']);
});

Route::prefix('wishlist')->group(function () {
    Route::post('add', [WishlistController::class, 'add']);
    Route::post('delete', [WishlistController::class, 'deleteWishlist']);
    Route::get('get/{userID}', [WishlistController::class, 'getWishlist']);
});

Route::prefix('order-history')->group(function () {
    Route::get('{userID}', [OrderHistoryController::class, 'getOrderHistory']);
});

Route::get('is-payment/{bookId}/{userId}', [CartController::class, 'isPayment']);

Route::post('add-payment-history', [CartController::class, 'addPaymentHistory']);

Route::get('get-payment-history/{userId}', [CartController::class, 'getPaymentHistory']);
