<?php

use App\Http\Controllers\Api\v1\RecommenderController;
use App\Recommender\ProductSimilarity;
use Illuminate\Http\Request;
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

Route::post('/products/similarities', [RecommenderController::class, 'getSimilarities']);
