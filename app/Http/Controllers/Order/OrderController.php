<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redis;

class OrderController extends Controller
{
    public function orderDo(Request $request)
    {
//        $goods_id='1,2,3';
//        $cc=explode(',',$goods_id);
////        $uid=1;
////        $goods_id=$request->input();
////        $goodsInfo = DB::table('shop_goods')->where('goods_up',1)->whereIn('goods_id','1,2,3')->get();
//        print_r($cc);die;

    }
}