<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
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
//            session(['user_id'=>$user_id]);
            Cookie::queue('user_id',$user_id);
            $arr = ['status'=>1,'msg'=>'登录成功'];
            return $arr;
        }else{
            $arr = ['status'=>0,'msg'=>'登录失败'];
            return $arr;
        }
    }

    public function wxLog(){
        $scope = "snsapi_userinfo";
        $url = urlEncode ("http://team.alilili.top/wxCode");
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.env('WX_APPID').'&redirect_uri='.$url.'&response_type=code&scope='.$scope.'&state=STATE#wechat_redirect';
        header('Location:'.$url);
    }
    public function wxCode(Request $request){
        $data = $request->input();
        $code = $data['code'];
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.env('WX_APPID').'&secret='.env('WX_SECRET').'&code='.$code.'&grant_type=authorization_code';
        $responser = json_decode(file_get_contents($url),true);
        $openid = $responser['openid'];
        $accessToken = $responser['access_token'];
        $data = DB::table('shop_wx_user')->where('openid',$openid)->first();

        if($data){
            $url = "https://api.weixin.qq.com/sns/userinfo?access_token=$accessToken&openid=$openid&lang=zh_CN";
            $arr = json_decode(file_get_contents($url),true);
            $user_name = $arr['nickname'];
            $responser = [
                'erron'=>'0',
                'msg'=>'欢迎'.$user_name.'登陆,正在跳转首页'
            ];
            echo json_encode($responser,JSON_UNESCAPED_UNICODE);
            $user_id=$data->user_id;
            Cookie::queue('user_id',$user_id);
            header("Refresh:2;url='http://team.alilili.top/'");
        }else{
            $responser = [
                'erron'=>'40005',
                'msg'=>'账号未能绑定微信，去个人中心绑定！'
            ];
            echo json_encode($responser,JSON_UNESCAPED_UNICODE);
            header("Refresh:2;url='http://team.alilili.top/accreditUser'");
        }
    }

    public function out()  //退出登录
    {
//        cookie('user_id',null);
       setcookie('user_id', '', -1, '/');
//        echo $a ;die;
        return redirect('/');
    }
}
