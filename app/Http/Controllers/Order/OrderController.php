<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redis;

class OrderController extends Controller
{
    //订单入库
    public function orderDo(Request $request)
    {
        $goods_id2=$request->input('goods_id');
        $goods_id=rtrim($goods_id2,',');
//        $goods_id='1,2,3';

        $cc=explode(',',$goods_id);
        $uid=$request->cookie('user_id');
//                $uid=1;
//        $goods_id=$request->input();
        $goodsInfo = DB::table('shop_cart')->where('user_id',$uid)->whereIn('goods_id',$cc)->get();
        //订单号
        $order_number=substr(date('his').rand(11,9999).$uid,1,10);
        foreach ($goodsInfo as $k=>$v){
                if($v->status==1){
                    $price[]=$v->add_price;
                }
        }
        $add_price=array_sum($price);

        $data=[
            'order_number'=>$order_number,
            'user_id'=>$uid,
            'order_amount'=>$add_price,
            'order_message'=>'cc',
            'ctime'=>time()
        ];

        $orderId=DB::table('shop_order')->where('user_id',$uid)->insertGetId($data);
//        $goodsInfo2 = DB::table('shop_goods')->whereIn('goods_id',$cc)->get();
//        foreach ($goodsInfo2 as $k=>$v){
//            if($v->goods_up==1){
//                DB::table('shop_goods')->where('goods_id',$v->goods_id)->update(['goods_num',$v->goods_num-$v->buy_number]);
//            }
//        }

        foreach ($goodsInfo as  $k=>$v){
            $info=[
                'user_id'=>$uid,
                'order_id'=>$orderId,
                'goods_id'=>$v->goods_id,
                'goods_name'=>$v->goods_name,
                'goods_selfprice'=>$v->add_price,
                'goods_img'=>$v->goods_img,
                'buy_number'=>$v->buy_number,
                'order_number'=>$order_number,
                'ctime'=>time()
            ];
            $orderInfo=DB::table('shop_order_detail')->where('user_id',$uid)->insertGetId($info);
            DB::table('shop_cart')->where('goods_id',$v->goods_id)->update(['status'=>2]);
        }
        if($orderInfo){
            $response=[
                'errno'=>0,
                'msg'=>'下单成功',
                'orderId'=>$orderId
            ];
            return json_encode($response,JSON_UNESCAPED_UNICODE);
        }else{
            $response=[
                'errno'=>2,
                'msg'=>'下单失败',
            ];
            return json_encode($response,JSON_UNESCAPED_UNICODE);
        }

    }



    //详情展示
    public function index(Request $request){

        $orderId=$request->input('order_id');
//        $order_number=$request->input('order_number');
        $orderInfo=DB::table('shop_order')->where('order_id',$orderId)->first();
        $order_number=$orderInfo->order_number;

        $detailInfo=DB::table('shop_order_detail')->where(['shop_order_detail.order_number'=>$order_number,'shop_order.pay_status'=>1])
            ->join('shop_order','shop_order_detail.order_id','=','shop_order.order_id')
            ->get();

        $amount=[];
        foreach ($detailInfo as $k =>$v){
            $amount=$v->order_amount;
        }

        $arr=[
            'amount'=>$amount,
            'order_id'=>$orderId
        ];

//        $addressInfo=DB::table('shop_order_address')->where('user_id',$uid)->get();



        return view('order.index',['detailInfo'=>$detailInfo,'arr'=>$arr]);
    }


}