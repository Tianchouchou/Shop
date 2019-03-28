<?php

namespace App\Http\Controllers\Shop;

use App\Http\Requests\registercheck;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\CategoryModel;
use App\Model\GoodsModel;
use App\Model\UserModel;

class UserController extends Controller
{
    //商品首页
//    public function index()
//    {
//        $category_model=new CategoryModel;
//        $res=$category_model->where('pid',0)->limit(5)->get();
//        $goods_model=new GoodsModel;
//        $info=$goods_model->get();
//        return view('index',['data'=>$info,'result'=>$res]);
//    }
    //用户添加
    public function add(registercheck $request)
    {
        $request->validated();
        $user_tel=$request->user_tel;
        $user_pwd=$request->user_pwd;
        $user_pwd1=$request->user_pwd1;
        $where=[
            'user_tel'=>$user_tel,
            'user_pwd'=>md5($user_pwd)
        ];
        $user_model=new UserModel;
        $wheres=[
            'user_tel'=>$user_tel
        ];
        $result=$user_model->where($wheres)->first();
        if($result){
            $data=['font'=>'用户已存在','num'=>2];
            echo json_encode($data);
            exit;
        }
        $res=$user_model->insert($where);
        if($res){
            $data=['font'=>'注册成功','num'=>1];
            echo json_encode($data);
        }else{
            $data=['font'=>'注册失败','num'=>2];
            echo json_encode($data);
            exit;
        }



    }
    //全部商品
    public function show(Request $request)
    {
        $cate_id=$request->cate_id;
        $category=new CategoryModel;
        $goods_model=new GoodsModel;

        $res=$category->where('cate_navshow',1)->get();//左侧导航
        //dd($res);
        if(empty($cate_id)){
            $ress=$goods_model->get();
            return view('allshops',['ress'=>$ress,'res'=>$res]);
        }else{
            $cateinfo=$category->get();
            $res=$this->cateinfo($cateinfo,$cate_id);
            $goods_model=new GoodsModel;
            $ids=[];
            foreach($res as $k=>$v){
                $ids[]+=$v['cate_id'];
            }
            $where=[
                'cate_id'=>['in',$ids],
                'is_up'=>1
            ];
            $result=$goods_model->whereIn('cate_id',$ids)->where('is_up',1)->get();
            echo view('allshops',['res'=>$res,'ress'=>$result]);
        }

    }
    //查询子节点 循环查询商品数据
    public function searchson(Request $request)
    {
      $cate_id=empty($request->cate_id)?0:$request->cate_id;
      $cate_model=new CategoryModel;
      $cateinfo=$cate_model->get();
     //dd($cateinfo);
      $res=$this->cateinfo($cateinfo,$cate_id);
      $goods_model=new GoodsModel;
      $ids=[];
     foreach($res as $k=>$v){
         $ids[]+=$v['cate_id'];
     }
     $where=[
         'cate_id'=>['in',$ids],
         'is_up'=>1
     ];
     $result=$goods_model->whereIn('cate_id',$ids)->where('is_up',1)->get();
     echo view('fgoods',['res'=>$result]);
    }
    //递归查询
    function cateinfo($cateinfo,$pid)
     {
        static $info=[];
        foreach($cateinfo as $k=>$v){
            If($v['pid']==$pid){
                $info[]=$v;
                $this->cateinfo($cateinfo,$v['cate_id']);
            }
        }
        return $info;
     }
     //ajax提交验证手机号是否存在
    public function checktel(Request $request)
    {
        $tel=$request->tel;
        if($tel==''){
            $data=['font'=>'手机号不能为空','num'=>2];
            exit;
        }
        $user_model=new UserModel();
        $where=[
            'user_tel'=>$tel
        ];

        $res=$user_model->where($where)->first();
        //dd($res);
        if($res){
            $data=['font'=>'手机号已经被注册，请更换一个再试','num'=>2];
            echo json_encode($data);
            exit;
        }else{
            $data=['font'=>'手机号可用','num'=>1];
            echo json_encode($data);
        }

    }

}
