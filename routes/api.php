<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookApiController;
use App\Http\Controllers\Api\LoginApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('login', [LoginApiController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {

    Route::resource('books', BookApiController::class);

    Route::post('books/review-rating', [BookApiController::class, 'reviewRating']);
    
    Route::get('books/report/list', [BookApiController::class, 'report']);
});