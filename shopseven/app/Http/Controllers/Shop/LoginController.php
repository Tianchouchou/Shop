<?php

namespace App\Http\Controllers\Shop;

use App\Model\UserModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\AddcartModel;
use App\Model\GoodsModel;
use Illuminate\Support\Facades\DB;
use App\Model\AreaModel;
use App\Model\AddressModel;

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
//        dd(session('userid'));
        if($username==''){
            return view('login');
        }else{
            $addcart_model=new AddcartModel();
            $where=[
                'user_id'=>$user_id,
                'status'=>1
            ];
            $res=$addcart_model->where($where)->get();
            $goods_id=[];
            foreach ($res as $k=>$v){
                $goods_id[] += $v['goods_id'];
            }
            $wheres=[
                'addcart.status'=>1
            ];
            $result=DB::table('goods')
                ->join('addcart','goods.goods_id','=','addcart.goods_id')
                ->where($wheres)
                ->whereIn('addcart.goods_id',$goods_id)
                ->get();
            return view('shopcart',['data'=>$result]);

        }
    }

    //没有商品购物车页面
    public function shopcarts()
    {
        return view('shopcarts');
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
        $buy_num=1;
        if($goods_id==''){
            $data=['font'=>'商品不能为空','num'=>2];
            echo json_encode($data);
            return false;
        }
        $info=[
            'goods_id'=>$goods_id,
            'user_id'=>$user_id,
            'buy_num'=>$buy_num
        ];
        $addcart_model=new AddcartModel();
        $where=[
            'goods_id'=>$goods_id,
            'user_id'=>$user_id,
            'status'=>1
        ];
        $result=$addcart_model->where($where)->first();
        if(!empty($result)){
            //已经添加过，做累加
            $buy_num=$result['buy_num']+1;
            $res=$addcart_model->where($where)->update(['buy_num'=>$buy_num]);
        }else{
            //未添加过这个商品，追加
            $res=$addcart_model->insert($info);
        }
        ;
        if($res){
            $data=['font'=>'添加成功','num'=>1];
        }else{
            $data=['font'=>'添加失败','num'=>2];
        }
        echo json_encode($data);

    }

    //购物车单个商品删除
    public function goodsdel(Request $request)
    {
        $goods_id=$request->goods_id;
        $user_id=$request->user_id;
        $addcart_model=new AddcartModel();
        $where=[
            'goods_id'=>$goods_id,
            'user_id'=>$user_id
        ];
        $res=DB::table('addcart')
            ->where($where)
            ->update(['status' => 2]);
        if($res){
            $data=['font'=>'删除成功','num'=>1];
        }else{
            $data=['font'=>'删除失败','num'=>2];
        }
        echo json_encode($data);

    }

    //收货地址
    public function mywallet()
    {
        //获取当前登录人的id
        $user_id=session('userid');
        $where=[
            'user_id'=>$user_id
        ];
        $addressinfo=DB::table('address')
            ->where($where)
            ->get();
        $area_model=new AreaModel();
        if(!empty($addressinfo)){
            //处理收货地址的省市县
            foreach($addressinfo as $k=>$v){
                $v->province=$area_model->where(['id'=>"$v->province"])->value('name');
                $v->city=$area_model->where(['id'=>"$v->city"])->value('name');
                $v->county=$area_model->where(['id'=>"$v->county"])->value('name');
            }
        }else{
            return false;
        }
        return view('address',['addressinfo'=>$addressinfo]);
    }

    //收货地址添加
    public function addressad()
    {
        $add_model=new AreaModel();
        $areainfo=$add_model->where(['pid'=>0])->get();
        return view('writeaddr',['areainfo'=>$areainfo]);
    }

    //收货地址添加信息页面展示
    public function addressinfo(Request $request)
    {
        $id=$request->id;
        if($id==''){
            $data=['font'=>'请至少选择其中一项','num'=>2];
        }
        $info=$this->getareaInfo($id);
        echo json_encode(['areaInfo'=>$info,'num'=>1]);

    }

    //获取下一级的城市信息
    public function getareaInfo($pid)
    {
        $area_model=new AreaModel();
        $where=[
            'pid'=>$pid
        ];
        $res=$area_model->where($where)->get();
        if($res){
            return $res;
        }else{
            return false;
        }
    }

    //收货地址添加
    public function addresssave(Request $request)
    {
        $addressinfo=$request->all();
        $area_model=new AddressModel();
        $res=DB::table('address')->insert($addressinfo);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }

    //设置默认
    public function setinfo(Request $request)
    {
        $address_id=$request->address_id;
        $user_id=$request->user_id;
        $address_model=new AddressModel();
        $where=[
            'user_id'=>$user_id,
            'address_id'=>$address_id
        ];
        $up=[
            'address_id'=>$address_id,
            'is_default'=>1
        ];
        //先修改所有为2，然后点击为1
        $res=$address_model->where(['user_id'=>$user_id])->update(['is_default'=>2]);
        $ress=$address_model->where($where)->update($up);
        if($res&&$ress){
            echo 1;
        }else{
            echo 2;
        }

    }

    //地址删除
    public function delinfo(Request $request)
    {
        $address_id=$request->address_id;
        $user_id=$request->user_id;
        $address_model=new AddressModel();
        $where=[
            'user_id'=>$user_id,
            'address_id'=>$address_id
        ];
        $res=$address_model->where($where)->delete();
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }

    //结账页面
    public function accounts(Request $request)
    {
        $goods_id=$request->goods_id;
        $user_id=$request->user_id;
        $goods_model=new GoodsModel();
        $goods_id=explode(',',$goods_id);
        $where=[
            'is_up'=>1,
            'status'=>1,
            'user_id'=>$user_id,
        ];
        $res=DB::table('goods')
            ->join('addcart','goods.goods_id','=','addcart.goods_id')
            ->where($where)
            ->whereIn('goods.goods_id',$goods_id)
            ->get();
        if($res){
            $data=['font'=>'准备前往结算','num'=>1];
            echo json_encode($data);
        }
    }

    //确认结算页面
    public function payment(Request $request)
    {
        $goods_id=$request->goods_id;
        $user_id=session('userid');
        $goods_id=explode(',',$goods_id);
        $where=[
            'is_up'=>1,
            'status'=>1,
            'user_id'=>$user_id,
        ];
        $res=DB::table('goods')
            ->join('addcart','goods.goods_id','=','addcart.goods_id')
            ->where($where)
            ->whereIn('goods.goods_id',$goods_id)
            ->get();
        $price=0;
        foreach ($res as $k=>$v){
            $price +=$v->buy_num*$v->self_price;
        }

        return view('payment',['res'=>$res,'price'=>$price]);
    }

    //搜索
    public function search(Request $request)
    {
        $name=$request->name;
        if($name==''){
            $data=['font'=>'不好意思，搜索项不能为空哦','num'=>2];
            echo json_encode($data);
        }
        $res=Db::table('goods')
            ->where('goods_name','like',"%$name%")
            ->get();
        //dd($res);
        if($res->first()){
            //yes
            $data=['font'=>'查询到数据准备跳转','num'=>1];
            echo json_encode($data);
            //return view('search',['res'=>$res]);
        }else{
            $data=['font'=>'搜索结果为空','num'=>2];
            echo json_encode($data);
        }
    }

    //搜索页面展示

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     */
    public function searchshow(Request $request)
    {
        $name=$request->name;
        $res=Db::table('goods')
            ->where('goods_name','like',"%$name%")
            ->get();
        return view('search',['res'=>$res]);
    }

    //同步
    public function tong()
    {
        echo 1;
    }
    //异步
    public function yi()
    {
        echo 2;
    }

    //加号减号改变购买量
    public function changenum(Request $request)
    {
        $buy_num=$request->buy_num;
        $goods_id=$request->goods_id;
        $user_id=session('userid');
        if($buy_num==''){
            $data=['font'=>'购买数量不能为空','num'=>2];
            exit;
        }else if($goods_id==''){
            $data=['font'=>'您还未登陆','num'=>2];
            exit;
        }else if($goods_id==’){
            $data=['font'=>'商品不能为空','num'=>2];
            exit;
        }
        $where=[
            'user_id'=>$user_id,
            'goods_id'=>$goods_id
        ];
        $up=[
            'buy_num'=>$buy_num
        ];
    }
}
