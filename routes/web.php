<?php

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

Auth::routes();

Route::post('currency/calculateAmount', 'CurrencyController@calculateAmount');
Route::post('currency/destroyAll', 'CurrencyController@destroyAll');
Route::resource('currency', 'CurrencyController');


Route::get('/home', 'HomeController@index');
Route::get('/', 'HomeController@index');
