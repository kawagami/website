<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', 'FrontendController@index')->name('index');
Route::get('/api/test', 'FrontendController@test')->name('test');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('home')->middleware(['auth', 'echo.test'])->group(function () {
    Route::resources(['stocks' => 'StocksController']);

    Route::resources(['failedemails' => 'manage\FailedEmailsController']);
});

Route::view('/{path?}', 'frontend.index');

Auth::routes(['verify' => true]);
Route::get('profile', function () {
    return "my email";
})->middleware('verified');
