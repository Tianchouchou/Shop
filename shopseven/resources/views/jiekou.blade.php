<?php
use App\Model\WeixinModel;
define('WEIXINTOKEN','weixinjiekou');
$weixincheck=new Weixincheck();
$weixincheck->valid();

class Weixincheck
{
    public function valid()
    {
//        $echostr=$_GET['echostr'];
//        if($this->checkSignature()){
//            echo $echostr;exit;
//        }
       $this->autoresponse();
    }

    //微信测试端口
    private function checkSignature()
    {
        $singnature=$_GET["signature"];
        $timestamp=$_GET["timestamp"];
        $nonce=$_GET["nonce"];
        $token=WEIXINTOKEN;
        //将三个参数编入数组
        $arr=array($token,$timestamp,$nonce);
        //字典排序
        sort($arr, SORT_STRING);
        //拼接参数
        $tmpStr = implode( $arr );
        //加密
        $tmpStr = sha1( $tmpStr );

        if($singnature==$tmpStr ){
            return true;
        }else{
            return false;
        }
    }

    //关注自动回复
    private function autoresponse()
    {
        //获取微信请求的所有内容
        $info=file_get_contents("php://input");
        //extract post data
        if (!empty($info)){
            $postObj = simplexml_load_string($info, 'SimpleXMLElement', LIBXML_NOCDATA);
            $fromUsername = $postObj->FromUserName;
            $toUsername = $postObj->ToUserName;
            $keyword = trim($postObj->Content);
            $time = time();
            $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
            if($postObj->MsgType=='event')
            {
                if($postObj->Event=='subscribe'){//如果为订阅(关注)
                    $msgType = "text";
                    $contentStr = "欢迎关注泽恩的小窝，一起快乐的成长吧O(∩_∩)O~";
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                    echo $resultStr;
                }
            }
            if($keyword=='你好'){
                $msgType = "text";
                $contentStr = "今天我不是特别好，因为很热~~~~";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            }else if(strpos($keyword,'天气')){//处理字，如果为查询天气
                $cityname=substr($keyword,0,strpos($keyword,'天气'));
                $url=file_get_contents("http://api.k780.com/?app=weather.today&weaid=$cityname&appkey=41380&sign=fca52ea36c3b651824f362c38bf9cbca&format=json");

                $msgType = "text";
                $weather=json_decode($url,true);
                $code=$weather['success'];
                if($code){
                    $result=$weather['result'];
                    $thiscity="城市：".$result['citynm']."\r\n";
                    $date="今天是：".$result['days'].$result['week']."\r\n";
                    $temperature="气温：".$result['temperature']."\r\n";
                    $weathers="天气：".$result['weather']."\r\n";
                    $humidity="湿度：".$result['humidity']."\r\n";
                    $wind="风向:".$result['wind']."\r\n";
                    $wen="春天气候干燥，气温变化比较大，请您及时补充水分，不要太着急换短袖哦~~";
                    $contentStr=$date.$thiscity.$temperature.$weathers.$humidity.$wind.$wen;

                }else{
                    $contentStr ="小主，您问的问题咱不懂呢~~要不您换个标准的？" ;
                }

                $contentStr =$contentStr ;
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            }else{
                $data=[
                    'perception'=>[
                        'inputText'=>[
                            'text'=>$keyword
                        ]
                    ],
                    'userInfo'=>[
                        'apiKey'=>'64e0b5447d1f450c8c01ad127ce8cf95',
                        'userId'=>123123,
                    ]
                   ];
                $post_data=json_encode($data);//变成json数据
                $url="http://openapi.tuling123.com/openapi/api/v2";
                $re=WeixinModel::HttpPost($url,$post_data);//调用模板，传送数据
                $msg=json_decode($re,true)['results'][0]['values']['text'];
                $msgType = "text";
                $contentStr = $msg;
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            }
        }else {
            echo "";
            exit;
        }

    }

}
