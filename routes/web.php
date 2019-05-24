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


Route::get('payIndex','Pay\PayController@index');
Route::get('pay','Pay\PayController@pay');


Route:get('AddressIndex','Address\AddressController@index');
Route:post('addressDo','Address\AddressController@addressDo');

