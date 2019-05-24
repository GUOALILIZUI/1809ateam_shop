<?php

namespace App\Http\Controllers\Product;

use App\Model\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Wish;
class ProductController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 商品展示
     */
    public function productList(){
        return view('product.productList');
    }

    /**
     * 流加载
     */
    public function products(Request $Request){
        $arr = array();
        $page = $Request->input('page',1);
        $pageNum=4;
        $offset = ($page-1)*$pageNum;
        $arrDataInfo = Product::offset($offset)->limit($page,$pageNum)->get();//每页的数据
        $totalData = Product::count();
        $pageTotal = ceil($totalData/$pageNum);//总条数
        $objview = view('product.products',['arrDataInfo'=>$arrDataInfo]);
        $content = response($objview)->getContent();
        $arr['info'] = $content;
        $arr['page'] = $pageTotal;
        return $arr;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 商品详情
     */
    public function shopSingle(){
        $goods_id = $_GET['goods_id'];
        $data = Product::where('goods_id',$goods_id)->first();
        return view('product.shopSingle',['data'=>$data]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 加入收藏
     */
    public function wish(Request $request){
        $goods_id = $request->input('goods_id');
        $user_id = session('u_id');

        if(empty($user_id)){
            $response = [
                'msg'=>'亲,请先登录，后收藏！',
                'status'=>2
            ];
            return $response;
        }
        $data = Product::where('goods_id',$goods_id)->first(['goods_name','goods_id','goods_num','goods_selfprice','goods_img'])->toArray();
        $arr = [
            'goods_name'=>$data['goods_name'],
            'goods_num'=>$data['goods_num'],
            'goods_id'=>$data['goods_id'],
            'goods_selfprice'=>$data['goods_selfprice'],
            'goods_img'=>$data['goods_img'],
            'user_id'=>$user_id
        ];
        $resWhere=[
            'user_id'=>$user_id,
            'goods_id'=>$data['goods_id']
        ];


        $res = Wish::where($resWhere)->first();
        if($res){
                $response = [
                    'msg'=>'您已经收藏过该宝贝了！！！',
                    'status'=>1
                ];
                return $response;
        }else{
            $res =Wish::insert($arr);
            if($data){
                $response = [
                    'msg'=>'收藏成功',
                    'status'=>0
                ];
                return $response;
            }
        }

    }
    /**
     * 收藏展示
     */
    public function wishList(){
        $user_id = session('user_id');

        if(empty($user_id)){
            $response = [
                'msg'=>'亲,请先登录，后收藏！',
                'status'=>2
            ];
            return json_encode($response,JSON_UNESCAPED_UNICODE);
        }
        $data = Wish::where('user_id',1)->where('like_status',0)->get();

        return view('wish.wishList',['data'=>$data]);
    }
    /**
     * 取消收藏
     */
    public function wishDel(Request $request){
        $goods_id = $request->input('goods_id');
        $user_id = session('user_id');

        $where =[
            'user_id'=>$user_id,
            'goods_id'=>$goods_id,
        ];
        $updateWhere = [
            'like_status'=>1
        ];
        $data = Wish::where($where)->update($updateWhere);
        if($data){
            $response = [
                'msg'=>'已取消收藏',
                'status'=>0
            ];
            return $response;
        }else{
            $response = [
                'msg'=>'取消收藏失败',
                'status'=>1
            ];
            return $response;
        }
    }
}