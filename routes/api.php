<?php

use App\Http\Controllers\Api\JwtController;
use App\Http\Controllers\AreaTime\TimeController;
use App\Http\Controllers\Version\PortfolioController;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//JwtController
Route::group(['prefix'=> 'auth'], function () {
    Route::post('/register', [JwtController::class, 'register']);
    Route::post('/login', [JwtController::class, 'login']);
    Route::post('/me', [JwtController::class, 'me']);
    Route::post('/refresh', [JwtController::class, 'refresh']);
    Route::post('/checkToken', [JwtController::class, 'checkToken']);
});

Route::group(['prefix'=> 'area'], function () {
    Route::post('/saveTime', [TimeController::class, 'saveTime']);
});

Route::group(['prefix'=> 'folio'], function () {
    Route::post('/InsPoerfolio', [PortfolioController::class,'InsPoerfolio']);
    Route::get('/GetPoerfolio', [PortfolioController::class,'GetPoerfolio']);
});