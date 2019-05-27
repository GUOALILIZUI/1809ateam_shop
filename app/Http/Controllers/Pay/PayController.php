<?php
namespace App\Http\Controllers\Pay;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class PayController extends Controller
{
    public $app_id;
    public $gate_way;
    public $notify_url;
    public $return_url;
    public $rsaPrivateKeyFilePath;
    public $aliPubKey;




    /**
     * 支付视图
     */
    public function index(){
        return view('pay.index');
    }



    public function __construct()
    {
        $this->app_id = env('ALIPAY_APPID');
        $this->gate_way = 'https://openapi.alipaydev.com/gateway.do';
        $this->notify_url = env('ALIPAY_NOTIFY_URL');
        $this->return_url = env('ALIPAY_RETURN_URL');
        $this->rsaPrivateKeyFilePath = storage_path('app/pay/private.key');    //应用私钥
        $this->aliPubKey = storage_path('app/pay/public.key'); //支付宝公钥
    }
    public function test()
    {
        echo $this->aliPubKey;echo '</br>';
        echo $this->rsaPrivateKeyFilePath;echo '</br>';
    }
    /**
     * 订单支付
     * @param $oid
     */
    public function pay()
    {
        $order_id=$_GET['order_id'];
        //验证订单状态 是否已支付 是否是有效订单
        $order_info = DB::table('shop_order')->where(['order_id'=>$order_id])->first();
//        echo '<pre>';print_r($order_info);echo '</pre>';echo '<hr>';
        //判断订单是否已被支付
        if($order_info->pay_status>1){
            die("订单已支付，请勿重复支付");
        }
        //业务参数
        $bizcont = [
            'subject'           => 'Lening-Order: ' .$order_id, //order_id
            'out_trade_no'      => $order_info->order_number,        //订单号
            'total_amount'      => $order_info->order_amount,
            'product_code'      => 'QUICK_WAP_WAY',
        ];
        //公共参数
        $data = [
            'app_id'   => $this->app_id,
            'method'   => 'alipay.trade.wap.pay',
            'format'   => 'JSON',
            'charset'   => 'utf-8',
            'sign_type'   => 'RSA2',
            'timestamp'   => date('Y-m-d H:i:s'),
            'version'   => '1.0',
            'notify_url'   => $this->notify_url,        //异步通知地址
            'return_url'   => $this->return_url,        // 同步通知地址
            'biz_content'   => json_encode($bizcont),
        ];
        //签名
        $sign = $this->rsaSign($data);
        $data['sign'] = $sign;
        $param_str = '?';
        foreach($data as $k=>$v){
            $param_str .= $k.'='.urlencode($v) . '&';
        }
        $url = rtrim($param_str,'&');
        $url = $this->gate_way . $url;
        header("Location:".$url);       // 重定向到支付宝支付页面
    }
    public function rsaSign($params) {
        return $this->sign($this->getSignContent($params));
    }
    protected function sign($data) {
        $priKey = file_get_contents($this->rsaPrivateKeyFilePath);
        $res = openssl_get_privatekey($priKey);
        ($res) or die('您使用的私钥格式错误，请检查RSA私钥配置');
        openssl_sign($data, $sign, $res, OPENSSL_ALGO_SHA256);
        if(!$this->checkEmpty($this->rsaPrivateKeyFilePath)){
            openssl_free_key($res);
        }
        $sign = base64_encode($sign);
        return $sign;
    }
    public function getSignContent($params) {
        ksort($params);
        $stringToBeSigned = "";
        $i = 0;
        foreach ($params as $k => $v) {
            if (false === $this->checkEmpty($v) && "@" != substr($v, 0, 1)) {
                // 转换成目标字符集
                $v = $this->characet($v, 'UTF-8');
                if ($i == 0) {
                    $stringToBeSigned .= "$k" . "=" . "$v";
                } else {
                    $stringToBeSigned .= "&" . "$k" . "=" . "$v";
                }
                $i++;
            }
        }
        unset ($k, $v);
        return $stringToBeSigned;
    }
    protected function checkEmpty($value) {
        if (!isset($value))
            return true;
        if ($value === null)
            return true;
        if (trim($value) === "")
            return true;
        return false;
    }
    /**
     * 转换字符集编码
     * @param $data
     * @param $targetCharset
     * @return string
     */
    function characet($data, $targetCharset) {
        if (!empty($data)) {
            $fileType = 'UTF-8';
            if (strcasecmp($fileType, $targetCharset) != 0) {
                $data = mb_convert_encoding($data, $targetCharset, $fileType);
            }
        }
        return $data;
    }
    /**
     * 支付宝异步通知
     */
    public function notify()
    {
        $pay = json_encode($_POST);
        $log_str = "\n>>>>>> " .date('Y-m-d H:i:s') . ' '.$pay . " \n";
        file_put_contents('/tmp/1809a_team.log',$log_str,FILE_APPEND);
        $data=json_decode($pay,true);
        if($data['trade_status']=='TRADE_SUCCESS'){
            $where=[
                'order_id'=>$data['out_trade_no'],
            ];
            $time=strtotime($data['notify_time']);
            $info=[
                'order_pay_status'=>2,
                'pay_type'=>1,
                'pay_time'=>$time,
                'utime'=>$time,
            ];
            DB::table('shop_order')->where($where)->update($info);
            DB::table('shop_order_detail')->where($where)->update(['detail_status'=>2]);


        }

        //TODO 验签 更新订单状态
    }
    /**
     * 支付宝同步通知
     */
    public function aliReturn()
    {
        echo '支付成功';
    }
}
?>

