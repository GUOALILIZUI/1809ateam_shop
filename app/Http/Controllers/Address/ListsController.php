<?php

namespace App\Http\Controllers\Address;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ListsController extends Controller
{
    public function lists(Request $request)
    {
        $cookie_id = $request->cookie('user_id');
//        print_r($cookie_id);die;
        if ($cookie_id){
            $arr = DB::table('shop_order_address')->where('user_id',$cookie_id)->get();
//            print_r($arr);exit;
            $res = DB::table('shop_order_address')->where('user_id',$cookie_id)->where('goods_status',2)->first();

            return view('address.lists',['arr'=>$arr,'res'=>$res]);

        }else{

//            $arr = ['status'=>3,'msg'=>'请先登录'];
//            $arr = json_encode($arr,JSON_UNESCAPED_UNICODE);
//            return $arr;
            header('Refresh:3;url=log');
            die("请先登录,自动跳转至登录页面");

        }

    }
}
