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
Route::post('/test', 'FrontendController@test')->name('test');
// Route::resource('index', 'FrontendController', [
//     'name' => [
//         'index' => 'index',
//         'store' => 'index.store',
//         'create' => 'index.create',
//         'show' => 'index.show',
//         'update' => 'index.update',
//         'destroy' => 'index.destroy',
//         'edit' => 'index.edit'
//     ]
// ]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::view('/{path?}', 'frontend.index');
