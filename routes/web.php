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


Route::get('index', 'Index\IndexController@index');  //首页展示

Route::get('reg', 'Login\RegController@reg');  //注册展示

Route::post('register', 'Login\RegController@register');  //注册执行

Route::get('log', 'Login\LogController@log');  //登录展示

Route::post('login', 'Login\LogController@login');  //登录执行




