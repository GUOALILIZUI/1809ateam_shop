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
        $user_tel = $data['user_tel'];
        $user_code = $data['user_code'];

        $names = DB::table('shop_user')->where('user_name',$user_name)->first();
        if ($names){
            $arr = ['status'=>3,'msg'=>'用户已存在'];
            return $arr;
        }

        $tel = DB::table('shop_code')->where('tel',$user_tel)->first();
        if($tel){
            $arr = ['status'=>5,'msg'=>'手机号已存在'];
            return $arr;
        }


        $time = time();
        $where = [
            'tel'     => $user_tel,
            'code'    => $user_code,
            'status'  => 1,
        ];

        $arr = DB::table('shop_code')->where($where)->where("timeout",">",$time)->first();
//        print_r($arr);die;
        if(!empty($arr)) {
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
        }else{
            $arr = ['status'=>4,'msg'=>'验证码错误'];
            return $arr;
        }


    }

    //短信
    public function getcode(Request $request){
        $tel = $request->input("tel");
        // var_dump($tel);exit;
        $num = rand(1000,9999);
//        $obj = new \send();

        $bol = $this->show($tel,$num);
        if ($bol == 100) {
            $arr = array(
                'tel'=>$tel,
                'code'=>$num,
                'timeout'=>time()+3600,

            );
            $bol = DB::table('shop_code')->insert($arr);
            var_dump($arr);exit;
            var_dump($bol);
        }
    }

    public function show($tel,$num){

        $content = "您的验证码是：【{$num}】。如需帮助请联系客服。";//
        $ch = curl_init();//初始化
        $arr= config('app.send');
        $str="{$arr['url']}?account={$arr['username']}&password={$arr['pwd']}&mobile={$tel}&content={$content}";
        curl_setopt($ch,CURLOPT_URL, $str);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $info = curl_exec($ch);
        var_dump($info);
        return $info;
    }


}
