<?php

namespace App\Http\Controllers\cart;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\cart\Cart;

class CartController extends Controller
{
    //
    //添加展示
    public function cartList(Request $request)
    {
        //条件 个人u_id
        $where = [
            'user_id'=>1,
            'status'=>1
        ];
        $res=Cart::where($where)->get();//查询个人cart
        //
        $num = 0;
        //购物车总价
        foreach ($res as $k=>$v){
                $num += $v->add_price*$v->buy_number;
        }
        return view('cart/cart',['res'=>$res,'num'=>$num]);
    }
    //购物车列表删除操作
    public function delCart(Request $request)
    {
        //接受id
        $cart_id= $request->cart_id;
        //删除条件
        $where = [
            'user_id'=>1,
            'cart_id'=>$cart_id
        ];
        $res=Cart::where($where)->update(['status'=>2]);
        if($res){
            $data = [
                'error'=>0,
                'msg' => '删除成功'
            ];
            $json=json_encode($data);
        }else{
            $data = [
                'error'=>0,
                'msg' => '删除失败'
            ];
            $json=json_encode($data);
        }
        echo $json;
    }
    public function cartnum(Request $request)
    {
        $num=$request ->input('num');
        $cart_id=$request ->input('zc');
        $z= '/^[1-9]$/';
        if(!preg_match($z,$num)){
            $data = [
                'error'=>0,
                'msg' => '请填写正确数量'
            ];
            $json=json_encode($data);
            return $json;
        }
        $where = [
            'user_id'=>1,
            'cart_id'=>$cart_id
        ];
        $res=Cart::where($where)->update(['buy_number'=>$num]);
        if($res){
            $data = [
                'error'=>0,
                'msg' => 'ok'
            ];

        }else{
            $data = [
                'error'=>1,
                'msg' => '添加数量失败，可能数量不足'
            ];
        }
        $json=json_encode($data);
        return $json;
    }
    public function addcart(Request $request)
    {
        $goods_id=$request->input('goods_id');
        $where=[
            'goods_id'=>$goods_id
        ];
        //判断存在商品是否存在
        $res=Cart::where($where)->first();
        if($res){
            $data = [
                'goods_name'=>$res->goods_name,
                'goods_id'=>$res->goods_id,
                'user_id'=>1,
                'buy_number'=>1,
                'ctime'=>time(),
                'add_price'=>$res->goods_selfprice,
            ];

            $data_info=Cart::insertGetId($data);
            if($data_info){
                $data = [
                    'error'=>0,
                    'msg' => '添加成功'
                ];
            }else{
                    $data = [
                        'error'=>1,
                        'msg' => '添加失败'
                    ];
                }
                $json=json_encode($data);
                return $json;
            }
        }
}
