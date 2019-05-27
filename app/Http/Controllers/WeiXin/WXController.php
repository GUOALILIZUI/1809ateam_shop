<?php

namespace App\Http\Controllers\WeiXin;
use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class WXController extends Controller
{
    public function accredit(){
        $scope = "snsapi_userinfo";
        $url = urlEncode ("http://team.alilili.top/code");
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.env('WX_APPID').'&redirect_uri='.$url.'&response_type=code&scope='.$scope.'&state=STATE#wechat_redirect';
        header('Location:'.$url);
    }
    public function code(Request $request){
        $data = $request->input();
        $code = $data['code'];
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.env('WX_APPID').'&secret='.env('WX_SECRET').'&code='.$code.'&grant_type=authorization_code';
        $responser = json_decode(file_get_contents($url),true);
        $user_id = $request->cookie('user_id');
        $openid = $responser['openid'];

    }
    /**
     * @return mixed
     * 获取微信accessToken
     */
    public function accessToken(){
        $key = 'access_token';
        $accessToken = Redis::get($key);
        if($accessToken){
            return $accessToken;
        }else{
            $url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.env('WX_APPID').'&secret='.env('WX_SECRET').'';
            $response = file_get_contents($url);
            $arr = json_decode($response,true);
            $access = $arr['access_token'];
            Redis::set($key,$access);
            Redis::expire($key,3600);
            $accessToken = $arr['access_token'];
            return $accessToken;
        }
    }
}