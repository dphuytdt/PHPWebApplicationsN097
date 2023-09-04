<?php

use App\Http\Controllers\Api\v1\InteractionController;
use Illuminate\Support\Facades\Route;

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
//Route::prefix('comment')->group(function () {
//    Route::prefix('admin')->group(function () {
//        Route::get('manage-comments', [InteractionController::class, 'manageComments'])->name('manageComments');
//    });
//
//    Route::post('/', [InteractionController::class, 'comment'])->name('comment');
//    Route::get('{id}', [InteractionController::class, 'show'])->name('show');
//});
//
//Route::post("reply", [InteractionController::class, "reply"])->name("reply");

Route::prefix('comment')->group(function () {
    Route::get('/admin/manage-comments', [InteractionController::class, 'manageComments'])->name('manageComments');
    Route::get('/{target_id}/{type}', [InteractionController::class, 'getComment']);
    Route::post('/', [InteractionController::class, 'commentStore']);
    Route::post('delete', [InteractionController::class, 'commentDelete']);
    Route::post('reply', [InteractionController::class, 'replyComment']);
    Route::put('/{id}', [InteractionController::class, 'commentUpdate']);
});
