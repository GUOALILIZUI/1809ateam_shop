<?php

namespace App\Http\Controllers\WeiXin;
use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class WXController extends Controller
{
    public $response = [];
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

        $this->response = $responser;
        header('Refresh:1;url="http://team.alilili.top/accreditUser"');
    }
    public function accreditUser(){
        return view('weixin.accreditUser');
    }
    public function accreditDo(Request $request){
        $data = $request->input();
        $user_name = $data['user_name'];
        $user_pass = $data['user_pass'];

        $arr = DB::table('shop_user')->where('user_name',$user_name)->first();
        if ($arr){
            if ($user_pass != $arr->user_pass){
                $arr = ['status'=>1,'msg'=>'账号或密码错误'];
                return $arr;
            }
            $user_id=$arr->user_id;

            print_r($this->response);die;
            $arr = DB::table('shop_wx_user')->where('openid',$this->response['openid'])->first();
            if($arr){
                $arr = ['status'=>2,'msg'=>'该账户已被绑定'];
                return $arr;
            }else{
                $where = [
                    'wx_user_name'=>$this->response['nickname'],
                    'openid'=>$this->response['openid'],
                    'user_id'=>$user_id
                ];
                $data = DB::table('shop_wx_user')->insert($where);
                if($data){
                    $arr = ['status'=>0,'msg'=>'绑定成功'];
                    return $arr;
                }
            }
        }
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