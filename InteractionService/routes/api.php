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

Route::post('comment', [InteractionController::class, 'comment'])->name('comment');
Route::get('comment/{id}', [InteractionController::class, 'show'])->name('show');
Route::post("/reply", [InteractionController::class, "reply"])->name("reply");
