<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\WeixinModel;

class WeixinController extends Controller
{
    /*
     * 获取access_token
     * $appid第三方用户唯一凭证
     * $secret第三方用户唯一凭证密钥，即appsecret
     * */
   function gettoken()
   {
       $appid="wx6f086ad7a15feb25";
       $secret="4275d4f26e5c42c7de27d0fb8ee9d7e1";
       $url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$secret";
       $token=(array)json_decode(file_get_contents($url)) ;
       $access_token=$token['access_token'];
       return $access_token;
   }

   /*
    * 将获取的access_token保存在文件中
    *$path,文件保存路径$str保存token的文件
    * 1、判断文件是否为空，为空就获取token并保存
    * is_file — 判断给定文件名是否为一个正常的文件
    * 2、如果不为空，判断token是否过期
    * */
   public function savetoken()
   {
       $path=public_path().'/wx';
       $filename=$path."/access_token.txt";
       if(is_file($filename)){
           //获取文件里面的值
           $str=file_get_contents($filename);
           if(empty($str)){
               //空，获取token，保存,设置过期时间
               $token=$this->gettoken();
               $expirationtime=time()+7000;//过期时间
               $arr=[
                 'access_token'=>$token,
                 'expirationtime'=>$expirationtime
               ];
               $str=json_encode($arr);
               file_put_contents($filename,$str);
           }else{
               //不为空
               $nowtime=time();
               $data=(array)json_decode($str);
               //判断是否过期,过期就重新获取，不过期就返回
               if($nowtime>$data['expirationtime']){
                   $token=$this->gettoken();
                   $expirationtime=time()+7000;//过期时间
                   $arr=[
                       'access_token'=>$token,
                       'expirationtime'=>$expirationtime
                   ];
                   $str=json_encode($arr);
                   file_put_contents($filename,$str);
               }else{
                    $token=$data['access_token'];
               }
           }
       }else{
           //文件不存在，创建文件夹
           touch($filename);
       }

   }
}
