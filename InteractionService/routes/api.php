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
Route::prefix('comment')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('manage-comments', [InteractionController::class, 'manageComments'])->name('manageComments');
    });

    Route::post('/', [InteractionController::class, 'comment'])->name('comment');
    Route::get('{id}', [InteractionController::class, 'show'])->name('show');
});

Route::post("reply", [InteractionController::class, "reply"])->name("reply");

