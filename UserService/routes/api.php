<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\UserController;
use App\Http\Controllers\Api\v1\AdminAuthController;
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

Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('user-profile', [AuthController::class, 'userProfile']);
    Route::post('change-pass', [AuthController::class, 'changePassWord']);   
    Route::get('check-auth', [AuthController::class, 'checkAuth']); 
    Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('verify-otp', [AuthController::class, 'verifyOTP']);
    Route::post('reset-password', [AuthController::class, 'resetPassword']);
    Route::post('verify-account', [AuthController::class, 'verifyAccount']);
    Route::post('resend-otp', [AuthController::class, 'resendOTP']);


    Route::group(['prefix' => 'admin'], function ($router) {
        Route::post('login', [AdminAuthController::class, 'login']);
        Route::post('logout', [AdminAuthController::class, 'logout']);
        Route::get('user', [UserController::class, 'getAllUser']);
        Route::post('request-reset-password', [AdminAuthController::class, 'requestResetPassword']);
    });

    Route::post('upgrate-user', [UserController::class, 'upgrateUser']);
    Route::post('user-detail', [UserController::class, 'userDetail']);
});