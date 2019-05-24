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

Route::get('product/productList','Product\ProductController@productList');   //商品展示
Route::post('product/products','Product\ProductController@products');        //流加载

Route::get('product/shopSingle','Product\ProductController@shopSingle');   //商品详情展示
Route::post('product/wish','Product\ProductController@wish');    //加入收藏
Route::get('wish/wishList','Product\ProductController@wishList');    //收藏展示
Route::post('wish/wishDel','Product\ProductController@wishDel');    //取消收藏