<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index(Request $request)
    {
//        $session_id = $request->session()->get('user_id');
//        print_r($session_id);die;

        $res = DB::table('shop_goods')->where('goods_new',1)->limit(2)->get();
        $arr = DB::table('shop_goods')->where('goods_up',1)->paginate(6);
//        print_r($arr);die;
        return view('index.index',['res'=>$res,'arr'=>$arr]);
    }


}
