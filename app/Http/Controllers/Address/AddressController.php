<?php

namespace App\Http\Controllers\Address;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    //
    public function index(){
        return view('address.index');
    }


    public function addressDo(Request $request){
        $site_name=$request->input('site_name');
        $site_tel=$request->input('site_tel');
        $province=$request->input('province');
        $city=$request->input('city');
        $detailed=$request->input('detailed');

        $user_id=session('user_id');

        $data=[
            'user_id'=>$user_id,
            'site_name'=>$site_name,
            'site_tel'=>$site_tel,
            'province'=>$province,
            'city'=>$city,
            'detailed'=>$detailed,
            'ctime'=>time()
        ];

        $res=DB::table('shop_order_address')->insertGetId($data);
        if($res){
            $response=[
                'errno'=>0,
                'msg'=>'添加成功',
            ];
            return $response;

        }else{
            $response=[
                'errno'=>2,
                'msg'=>'添加失败',
            ];
            return $response;

        }


    }
}
