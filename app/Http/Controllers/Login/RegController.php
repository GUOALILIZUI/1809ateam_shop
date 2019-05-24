<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RegController extends Controller
{
    public function reg()
    {
        return view('login.register');
    }

    public function register(Request $request)
    {
        $data = $request->input();
        $user_name = $data['user_name'];
        $user_email = $data['user_email'];
        $user_pass = $data['user_pass'];

        $names = DB::table('shop_user')->where('user_name',$user_name)->first();
        if ($names){
            $arr = ['status'=>3,'msg'=>'用户已存在'];
            return $arr;
        }

        $info = [
            'user_name' => $user_name,
            'user_email' => $user_email,
            'user_pass' => $user_pass,
        ];
        $arr = DB::table('shop_user')->insertGetId($info);
        if($arr){
            $arr = ['status'=>1,'msg'=>'注册成功'];
            return $arr;
        }else{
            $arr = ['status'=>0,'msg'=>'注册失败'];
            return $arr;
        }

    }
}
