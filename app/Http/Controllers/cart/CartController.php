<?php

namespace App\Http\Controllers\cart;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\cart\Cart;
use App\Model\Product;

class CartController extends Controller
{
    //
    //添加展示
    public function cartList(Request $request)
    {
       $user_id= $request->cookie('user_id');
           if($user_id) {
               //条件 个人u_id
               $where = [
                   'user_id' => $user_id,
                   'status' => 1
               ];
               $res = Cart::where($where)->get();//查询个人cart
               //
               $num = 0;
               //购物车总价
               foreach ($res as $k => $v) {
                   $num += $v->add_price * $v->buy_number;
               }
               return view('cart/cart', ['res' => $res, 'num' => $num]);
       }else{
               header('refresh:3;url="log"');
           }
    }
    //购物车列表删除操作
    public function delCart(Request $request)
    {
        $user_id= $request->cookie('user_id');
        if($user_id) {
            //接受id
            $cart_id= $request->cart_id;
            //删除条件
            $where = [
                'user_id'=>$user_id,
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
     }else{
            header('refresh:3;url="log"');
        }
    }
    public function cartnum(Request $request)
    {
        $user_id= $request->cookie('user_id');
        if($user_id) {
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
            'user_id'=>$user_id,
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
        }else{
            header('refresh:3;url="log"');
        }
    }

    public function addcart(Request $request)
    {
        $user_id= $request->cookie('user_id');
        if($user_id) {
            $goods_id = $request->input('goods_id');
            $where = [
                'goods_id' => $goods_id
            ];
            //判断购物车列表存在商品是否存在
            $res = Cart::where($where)->first();
            if ($res) {
                //条件
                $wheres = [
                    'goods_id' => $goods_id,
                    'user_id' => $user_id
                ];
                $cart_num = $res->buy_number + 1;
                //改数量
                $data_info = Cart::where($wheres)->update(['buy_number' => $cart_num]);
                if ($data_info) {
                    $data = [
                        'status' => 0,
                        'msg' => '添加成功'
                    ];
                } else {
                    $data = [
                        'status' => 1,
                        'msg' => '添加失败'
                    ];
                }
                $json = json_encode($data);
                return $json;
            } else {

                //查看商品是否存在
                $Product_info = Product::where($where)->first();
                if ($Product_info) {//如果存在
                    //TODO
                    $data = [
                        'goods_name' => $Product_info->goods_name,
                        'goods_id' => $Product_info->goods_id,
                        'user_id' => $user_id,
                        'buy_number' => 1,
                        'ctime' => time(),
                        'goods_img' => $Product_info->goods_img,
                        'add_price' => $Product_info->goods_selfprice
                    ];
                    $ss = Cart::insertGetId($data);
                    if ($ss) {
                        $data = [
                            'status' => 0,
                            'msg' => '添加成功'
                        ];

                    } else {
                        $data = [
                            'status' => 1,
                            'msg' => '添加失败'
                        ];
                    }
                    $json = json_encode($data);
                    return $json;
                }
            }
        }else{
            header('refresh:3;url="log"');
        }
        }
    }
