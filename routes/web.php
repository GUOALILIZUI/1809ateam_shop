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


Route::get('cartlist','cart\CartController@cartList');//购物侧展示列表
Route::get('delcart','cart\CartController@delCart');//购物车删除
Route::get('cartnum','cart\CartController@cartnum');//购物车添加购买数量



Route::post('addcart','cart\CartController@addcart');//添加购物车

