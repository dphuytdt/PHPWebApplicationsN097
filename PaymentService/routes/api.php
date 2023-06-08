<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\PaymentController;
use App\Http\Controllers\Api\v1\PaypalPaymentController;
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
// Route::group(['prefix' => 'payment/paypal'], function ($router) {
//     Route::post('/', [PaymentController::class, 'createPayment']);
//     Route::post('execute', [PaymentController::class, 'executePayment']);
//     Route::get('cancel', function () {
//         return response()->json(['message' => 'Payment Canceled']);
//     });
// });

Route::post('/payment', [PaypalPaymentController::class, 'makePayment'])->name('payment.make');
Route::get('/payment/success', [PaypalPaymentController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/payment/cancel', [PaypalPaymentController::class, 'paymentCancel'])->name('payment.cancel');