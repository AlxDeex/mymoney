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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => true]);

Route::get('/home', 'HomeController@spend');
Route::get('/home/spend', 'HomeController@spend');
Route::get('/home/gain', 'HomeController@gain');


Route::post('/transaction/add', 'TransactionController@create');
Route::get('/transaction/del/{id}/{type}', 'TransactionController@destroy');