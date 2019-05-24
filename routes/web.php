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

Route::get('index', 'Index\IndexController@index');  //首页展示
Route::get('reg', 'Login\RegController@reg');  //注册展示

Route::post('register', 'Login\RegController@register');  //注册执行

Route::get('log', 'Login\LogController@log');  //登录展示

Route::post('login', 'Login\LogController@login');  //登录执行
//支付
Route::get('payIndex','Pay\PayController@index');
Route::get('pay','Pay\PayController@pay');
Route::post('notify','Pay\PayController@notify');
Route::get('aliReturn','Pay\PayController@aliReturn');

//收货地址
Route::get('addressIndex','Address\AddressController@index');
Route::post('addressDo','Address\AddressController@addressDo');

//订单
Route::any('orderIndex','Order\OrderController@orderDo');

Route::get('product/productList','Product\ProductController@productList');   //商品展示
Route::post('product/products','Product\ProductController@products');        //流加载

Route::get('product/shopSingle','Product\ProductController@shopSingle');   //商品详情展示
Route::post('product/wish','Product\ProductController@wish');    //加入收藏
Route::get('wish/wishList','Product\ProductController@wishList');    //收藏展示
Route::post('wish/wishDel','Product\ProductController@wishDel');    //取消收藏

Route::get('payIndex','Pay\PayController@index');
Route::get('pay','Pay\PayController@pay');


//收货地址
Route::get('AddressIndex','Address\AddressController@index');
Route::post('addressDo','Address\AddressController@addressDo');

