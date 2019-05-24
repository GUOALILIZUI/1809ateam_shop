<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class LogController extends Controller
{
    public function log()  //登录展示
    {
        return view('login.login');
    }

    public function login(Request $request)  //登录执行 验证
    {
        $data = $request->input();
        $user_name = $data['user_name'];
        $user_pass = $data['user_pass'];

        $arr = DB::table('shop_user')->where('user_name',$user_name)->first();
        if ($arr){

            if ($user_pass != $arr->user_pass){

                $arr = ['status'=>3,'msg'=>'账号或密码错误'];
                return $arr;
            }


            $user_id=$arr->user_id;
//            var_dump($user_id);exit;
            session(['user_id'=>$user_id]);

            $arr = ['status'=>1,'msg'=>'登录成功'];
            return $arr;
        }else{
            $arr = ['status'=>0,'msg'=>'登录失败'];
            return $arr;
        }
    }
}
