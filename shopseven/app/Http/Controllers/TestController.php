<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class TestController extends Controller
{
    //memcached
    public function index(Request $request)
    {
        $search=$request->search;
        $page=$request->input('page',1);
        $key=$search.$page;
        if(Cache::has($key)){
            $res=Cache::get($key);
            echo '有';
        }else{
            $res=Db::table('goods')->where('goods_name','like',"%$search%")->paginate(2);
            Cache::put($key,$res,100);
            echo '没有';
        }

        return view('test',['res'=>$res,'search'=>$search]);
    }

    //redis
    public function indext(Request $request)
    {
        $name=$request->name;
        $page=$request->input('page',1);
        $key=$name.$page;
        if(Redis::exists($key)){
            $res=unserialize(Redis::get($key));
            echo 'you';
        }else{
            $res=Db::table('goods')->where('goods_name','like',"%$name%")->paginate(4);
            Redis::set($key,serialize($res));
            Redis::expire($key,100);
            echo 'meiyou';
        }

        return view('testt',['res'=>$res,'name'=>$name]);
    }

    //redisb
    public function indexb(Request $request)
    {
        $username=$request->username;
        $pwd=$request->pwd;
        if($username==''){
            echo '1';
        }else if($pwd==''){
            echo '1';
        }
        $where=[
            'user_tel'=>$username,
            'user_pwd'=>md5($pwd)
        ];
        $key=$username.$pwd;
//        Redis::del($key);
//        dd(1);
        if(Redis::exists($key)){
            $res=unserialize(Redis::get($key));
            echo '账号密码存入redis';
        }else{
            $res=DB::table('user')->where($where)->get();
            if(!$res->first()){
                echo '账号或密码错误';
            }else{
                Redis::set($key,serialize($res));
                Redis::expire($key,60);
                echo '账号密码正确';
            }
        }
        return view('testlogin');
    }
    public function changepwd()
    {
        return view('changepwd');
    }

}
