<?php

use App\Http\Controllers\Version\PhpInfoController;
use App\Http\Controllers\Version\PortfolioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// #region 登入註冊 顯示 JWT認證
Auth::routes();

#endregion

// #region HomeController 首頁

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

#endregion


// #region LanguageController 語言變更

Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => '\App\Http\Controllers\Language\LanguageController@switchLang']);

#endregion

// #region PhpInfoController php 資訊
Route::get('/phpinfo', [PhpInfoController::class, 'info']);
#endregion

// #region PortfolioController 作品集 資訊
Route::get('/portfolio', [PortfolioController::class,'folio']);
#endregion