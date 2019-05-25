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


// 注册登录 首页

Route::get('/', 'Index\IndexController@index');  //首页展示

Route::get('reg', 'Login\RegController@reg');  //注册展示

Route::post('register', 'Login\RegController@register');  //注册执行

Route::get('log', 'Login\LogController@log');  //登录展示

Route::post('login', 'Login\LogController@login');  //登录执行

//商品

Route::get('lists', 'Address\ListsController@lists');  //地址展示

Route::get('product/productList','Product\ProductController@productList');   //商品展示
Route::post('product/products','Product\ProductController@products');        //流加载
Route::post('product/productStatus','Product\ProductController@productStatus');   //商品分类 流
Route::get('product/shopSingle','Product\ProductController@shopSingle');   //商品详情展示
Route::post('product/wish','Product\ProductController@wish');    //加入收藏
Route::get('wish/wishList','Product\ProductController@wishList');    //收藏展示
Route::post('wish/wishDel','Product\ProductController@wishDel');    //取消收藏

//购物车
Route::get('cartlist','cart\CartController@cartList');//购物侧展示列表
Route::get('delcart','cart\CartController@delCart');//购物车删除
Route::get('cartnum','cart\CartController@cartnum');//购物车添加购买数量
Route::post('addcart','cart\CartController@addcart');//添加购物车


//支付宝支付
Route::get('payIndex','Pay\PayController@index'); //测试支付宝支付
Route::get('pay','Pay\PayController@pay');  //支付宝数据
Route::post('notify','Pay\PayController@notify');  //异步回调
Route::get('aliReturn','Pay\PayController@aliReturn');  //同步

//微信支付
Route::get('wxPay','WeiXin\WeiXinPayController@pay'); //微信数据
Route::post('wxPayBack','WeiXin\WeiXinPayController@payBack');  //微信回调
Route::get('paystatus','WeiXin\WeiXinPayController@paystatus');  //微信回调

//收货地址
Route::get('addressIndex','Address\AddressController@index'); //收货地址添加
Route::post('addressDo','Address\AddressController@addressDo');  //添加数据

//订单
Route::any('orderIndex','Order\OrderController@orderDo'); //订单展示





