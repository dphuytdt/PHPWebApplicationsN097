<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
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
// });

//route for Auth
Route::prefix('auth')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'postLogin'])->name('postLogin');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'postRegister'])->name('postRegister');

    Route::prefix('choose')->group(function () {
        Route::get('/district', [AuthController::class, 'chooseDistrict'])->name('register.choose.district');
        Route::get('/ward', [AuthController::class, 'chooseWard'])->name('register.choose.ward');
    });

    Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgotPassword');
    Route::post('/forgot-password', [AuthController::class, 'postForgotPassword'])->name('postForgotPassword');

    Route::get('/input-otp', [AuthController::class, 'inputOtp'])->name('inputOtp');
    Route::post('/input-otp', [AuthController::class, 'postInputOtp'])->name('postInputOtp');
});