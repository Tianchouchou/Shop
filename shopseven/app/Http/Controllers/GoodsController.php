<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Goods;
use App\Model\CategoryModel;
class GoodsController extends Controller
{
    public function shopcontent(Request $request){
        $data=$request->all();
        $where=['goods_id'=>$data['goods_id']];
        $shopinfo=Goods::where($where)->first();
        $goodsimgs= $shopinfo->goods_imgs;
        $goods_imgs=explode('|',rtrim($goodsimgs,'|'));
        return view('shopcontent',['shop'=>$shopinfo,'img'=>$goods_imgs]);
    }
    //所有商品左侧导航栏
    public function shows()
    {
        $category=new CategoryModel;
        $res=$category->where('cate_navshow',1)->get();
        return view('allshops',['res'=>$res]);
    }


}
