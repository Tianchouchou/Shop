<?php

namespace App\Http\Controllers\Shop;

use App\Model\UserModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\AddcartModel;
use App\Model\GoodsModel;

class LoginController extends Controller
{
    /*
     * @content 生成随机验证码
     * @params $len  int   需要生成验证码的长度
     * @return  $code  string  生成的验证码
     * */

    public static function createcode($len)
    {
        $code = '';
        for($i=1;$i<=$len;$i++){
            $code .=mt_rand(0,9);
        }
        return $code;
    }
    /*
     * @content 发送手机验证码
     * @params  $mobile  要发送的手机号
     *
     * */
    public function sendMobile(Request $request)
    {
        $mobile=$request->tel;
        $host = "https://dxyzm.market.alicloudapi.com";
        $path = "/chuangxin/dxjk";
        $method = "POST";
        $appcode = "ebebb9d65e2f480783074adff765761c";
        $code = $this->createcode(4);
        session(['getcode'=>$code]);
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "content=【创信】你的验证码是：".$code."，3分钟内有效！&mobile=".$mobile;
        $bodys = "";
        $url = $host . $path . "?" . $querys;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        var_dump(curl_exec($curl));
    }
    /*
     *验证码检查
     * */
    public function codecheck(Request $request)
    {
        $code=$request->code;
        $scode=session('getcode');
        if($code!=$scode){
            $data=['font'=>'验证码输入不一致','num'=>2];
            echo json_encode($data);
        }else{
            $data=['font'=>'验证码匹配','num'=>1];
            echo json_encode($data);
        }
    }

    //登陆验证
    public function logincheck(Request $request)
    {
        $username=$request->username;
        $pwd=$request->pwd;
        $code=$request->code;
        $codes=session('verifycode');
        $user_model=new UserModel();
        $where=[
            'user_tel'=>$username
        ];
        $res=$user_model->where($where)->first();
        $userid=$res['id'];
        //dd($userid);
        if($res==''){
            $data=['font'=>'账号或者密码错误','num'=>2];
        }else if ($res['user_pwd']!=md5($pwd)){
            $data=['font'=>'账号或者密码错误','num'=>2];
        }else if($code!=$codes){
            $data=['font'=>'验证码错误','num'=>2];
        }else{
            session(['username'=>$username,'userid'=>$userid]);
            $data=['font'=>'登陆成功','num'=>1];
        }
        echo json_encode($data);
    }

    //购物车页面
    public function shopcart()
    {
        $username=session('username');
        $user_id=session('userid');
        //dd(session('userid'));
        if($username==''){
            return view('login');
        }else{
            $addcart_model=new AddcartModel();
            $where=[
                'user_id'=>$user_id
            ];
            $res=$addcart_model->where($where)->get();
            $goods_id=[];
            foreach ($res as $k=>$v){
                $goods_id[] += $v['goods_id'];
            }
//            $goodswhere=[
//                'goods_id'=>['in',$goods_id]
//            ];
            $goods_model=new GoodsModel();
            $result=$goods_model->whereIn('goods_id',$goods_id)->get();
            return view('shopcart',['data'=>$result]);
        }

    }

    //我的潮购界面
    public function userpages()
    {
        $username=session('username');
        return view('userpage');
    }

    //商品加入购物车
    public function addcart(Request $request)
    {
        $goods_id=$request->goods_id;
        $user_id=$request->userid;
        if($goods_id==''){
            $data=['font'=>'商品不能为空','num'=>2];
            echo json_encode($data);
            return false;
        }
        $info=[
            'goods_id'=>$goods_id,
            'user_id'=>$user_id
        ];
        $addcart_model=new AddcartModel();
        //$result=$addcart_model->where('goods_id',$goods_id)->first();
        //dd($result);
//        if(!$request){
//            $data=['font'=>'您已添加过，请去购物车再添加','num'=>2];
//            echo json_encode($data);exit;
//        }
        $res=$addcart_model->insert($info);
        if($res){
            $data=['font'=>'添加成功','num'=>1];
        }else{
            $data=['font'=>'添加失败','num'=>2];
        }
        echo json_encode($data);

    }

}
