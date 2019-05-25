<?php

namespace App\Http\Controllers\Address;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ListsController extends Controller
{
    public function lists(Request $request)
    {
        $session_id = $request->session()->get('user_id');

        if ($session_id){
            $arr = DB::table('shop_order_address')->where('user_id',$session_id)->get();
//            print_r($arr);exit;

            return view('address.lists',['arr'=>$arr]);

        }else{

            $arr = ['status'=>3,'msg'=>'请先登录'];
            $arr = json_encode($arr,JSON_UNESCAPED_UNICODE);
            return $arr;
        }

    }
}
