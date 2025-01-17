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
    Route::post('update-profile/{id}', [UserController::class, 'updateProfile']);
    Route::post('change-pass/{id}', [AuthController::class, 'changePassWord']);
    Route::get('check-auth', [AuthController::class, 'checkAuth']);
    Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('verify-otp', [AuthController::class, 'verifyOTP']);
    Route::post('reset-password', [AuthController::class, 'resetPassword']);
    Route::post('verify-account', [AuthController::class, 'verifyAccount']);
    Route::post('resend-otp', [AuthController::class, 'resendOTP']);
    Route::post('profile/{id}', [AuthController::class, 'profile']);
    Route::post('upgrade-vip', [UserController::class, 'upgradeVip']);
    Route::post('user-detail/{id}', [UserController::class, 'userDetail']);


    Route::group(['prefix' => 'admin'], function ($router) {
        Route::post('login', [AdminAuthController::class, 'login']);
        Route::post('logout', [AdminAuthController::class, 'logout']);
        Route::group(['prefix' => 'user'], function ($router) {
            Route::get('/', [UserController::class, 'getAllUser']);
            Route::post('/', [UserController::class, 'store']);
            Route::post('import', [UserController::class, 'import']);
            Route::post('in-active/{id}', [UserController::class, 'destroy']);
            Route::get('{id}', [UserController::class, 'show']);
            Route::post('{id}', [UserController::class, 'update']);
            Route::post('request-reset-password', [AdminAuthController::class, 'requestResetPassword']);
        });
    });
});
