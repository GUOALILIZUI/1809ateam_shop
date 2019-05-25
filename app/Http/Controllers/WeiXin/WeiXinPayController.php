<?php

namespace App\Http\Controllers\WeiXin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class WeiXinPayController extends Controller
{
    /**消息拼接*/
    public $placeUrl="https://api.mch.weixin.qq.com/pay/unifiedorder";  // 统一下单接口
    public $backUrl="http://team.alilili.top/wxPayBack";  // 支付回调

    /**微信支付测试*/
    public function pay(){
        //支付账号
        $appId='wxd5af665b240b75d4';
        $mchId='1500086022';
        //用户要支付的总金额
        $total_fee=1;
        //订单id 随机生成
        $order_id=$_GET['order_id'];

        $orderInfo=DB::table('shop_order')->where('order_id',$order_id)->first();
        if($orderInfo->pay_status>1){
            die ('订单已支付，请勿重复支付');
        }
        $order_info=[
            'appid'=>$appId, //微信支付绑定的服务好APPID
            'mch_id'=>$mchId, //商户ID
            'nonce_str'=>Str::random(16), //随机16个字符的字符串
            'sign_type'=>'MD5',
            'body'=>'测试订单-'.mt_rand(1111,9999).Str::random(6),
            'out_trade_no'=>$orderInfo->order_number, //本地订单号
            'total_fee'=>$total_fee,
            'spbill_create_ip'=>$_SERVER['REMOTE_ADDR'], //客户端IP
            'notify_url'=>$this->backUrl, //通知回调地址
            'trade_type'=>'NATIVE'  //交易类型
        ];
//        print_r($order_info);die;
        $this->values=[];
        $this->values=$order_info;
        $this->SetSign();
        $xml=$this->ToXml();  //将数组转为xml
        $res=$this->postXmlCurl($xml,$this->placeUrl,$useCert=false,$second=30);
        $data=simplexml_load_string($res);
        //var_dump($data);
        /*
        echo 'return_code: '.$data->return_code;echo '<br>';
		echo 'return_msg: '.$data->return_msg;echo '<br>';
		echo 'appid: '.$data->appid;echo '<br>';
		echo 'mch_id: '.$data->mch_id;echo '<br>';
		echo 'nonce_str: '.$data->nonce_str;echo '<br>';
		echo 'sign: '.$data->sign;echo '<br>';
		echo 'result_code: '.$data->result_code;echo '<br>';
		echo 'prepay_id: '.$data->prepay_id;echo '<br>';
		echo 'trade_type: '.$data->trade_type;echo '<br>';
        echo 'code_url: '.$data->code_url;echo '<br>';
        */
        //将code_url 返回给前端 前端生成支付二维码

        $data=[
            'code_url'=>$data->code_url,
            'order_id'=>$order_id
        ];
        return view('weixin.pay',$data);


    }

    protected function ToXml()
    {
        if(!is_array($this->values)
            || count($this->values) <= 0)
        {
            die("数组数据异常！");
        }
        $xml = "<xml>";
        foreach ($this->values as $key=>$val)
        {
            if (is_numeric($val)){
                $xml.="<".$key.">".$val."</".$key.">";
            }else{
                $xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
            }
        }
        $xml.="</xml>";
        return $xml;
    }

    private  function postXmlCurl($xml, $url, $useCert = false, $second = 30)
    {
        $ch = curl_init();
        //设置超时
        curl_setopt($ch, CURLOPT_TIMEOUT, $second);
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,TRUE);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,2);//严格校验
        //设置header
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        //要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		//if($useCert == true){
			//设置证书
			//使用证书：cert 与 key 分别属于两个.pem文件
			//curl_setopt($ch,CURLOPT_SSLCERTTYPE,'PEM');
			//curl_setopt($ch,CURLOPT_SSLCERT, WxPayConfig::SSLCERT_PATH);
			//curl_setopt($ch,CURLOPT_SSLKEYTYPE,'PEM');
			//curl_setopt($ch,CURLOPT_SSLKEY, WxPayConfig::SSLKEY_PATH);
		//}
        //post提交方式
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
        //运行curl
        $data = curl_exec($ch);
        //返回结果
        if($data){
            curl_close($ch);
            return $data;
        } else {
            $error = curl_errno($ch);
            curl_close($ch);
            die("curl出错，错误码:$error");
        }
    }

    public function SetSign()
    {
        $sign = $this->MakeSign();
        $this->values['sign'] = $sign;
        return $sign;
    }

    private function MakeSign()
    {
        $key='7c4a8d09ca3762af61e59520943AB26Q';
        //签名步骤一：按字典序排序参数
        ksort($this->values);
        $string = $this->ToUrlParams();
        //签名步骤二：在string后加入KEY
        $string = $string . "&key=$key";
        //签名步骤三：MD5加密
        $string = md5($string);
        //签名步骤四：所有字符转为大写
        $result = strtoupper($string);
        return $result;
    }


    /**格式化参数格式化成url参数*/
    protected function ToUrlParams()
    {
        $buff = "";
        foreach ($this->values as $k => $v)
        {
            if($k != "sign" && $v != "" && !is_array($v)){
                $buff .= $k . "=" . $v . "&";
            }
        }
        $buff = trim($buff, "&");
        return $buff;
    }


    /**微信支付回调*/
    public function payBack()
    {
        $data = file_get_contents("php://input");
        //记录日志
        $log_str = date('Y-m-d H:i:s') . "\n" . $data . "\n<<<<<<<";
        file_put_contents('/tmp/wx_pay_notice.log',$log_str,FILE_APPEND);
        $xml = simplexml_load_string($data);
        if($xml->result_code=='SUCCESS' && $xml->return_code=='SUCCESS'){      //微信支付成功回调
            //验证签名
            $sign = true;
            if($sign){       //签名验证成功
                //TODO 逻辑处理  订单状态更新
            }else{
                //TODO 验签失败
                echo '验签失败，IP: '.$_SERVER['REMOTE_ADDR'];
                // TODO 记录日志
            }
        }
        $response = '<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>';
        echo $response;
    }

    /**
     * 微信同步
     */
    public function paystatus(Request $request)
    {
        $order_id = $request->input('order_id');
        $info = DB::table('shop_order')->where(['order_id'=>$order_id])->first();
        if($info){
            if($info->pay_status>1){      //已支付
                $response = [
                    'pay_status'    => 3,       // 0 已支付
                    'msg'       => 'ok'
                ];
                return json_encode($response,JSON_UNESCAPED_UNICODE);
            }
            //echo '<pre>';print_r($info->toArray());echo '</pre>';
        }else{
            die("订单不存在");
        }
    }


}
