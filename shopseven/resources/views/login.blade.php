<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>登录</title>
    <meta content="app-id=984819816" name="apple-itunes-app" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link href="/css/comm.css" rel="stylesheet" type="text/css" />
    <link href="/css/login.css" rel="stylesheet" type="text/css" />
    <link href="/css/vccode.css" rel="stylesheet" type="text/css" />
    <script src="/js/jquery-1.11.2.min.js"></script>
    <link rel="stylesheet" href="/layui/css/layui.css">
    <script src="/layui/layui.js"></script>

</head>
<body>
<input name="hidForward" type="hidden" id="hidForward" />
@csrf
<!--触屏版内页头部-->
<div class="m-block-header" id="div-header">
    <strong id="m-title">登录</strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="/" class="m-index-icon"><i class="home-icon"></i></a>
</div>

<div class="wrapper">
    <div class="registerCon">
        <div class="binSuccess5">
            <ul>
                <li class="accAndPwd">
                    <dl>
                        <div class="txtAccount">
                            <input id="txtAccount" name="username" type="text" placeholder="请输入您的手机号码/邮箱"><i></i>
                        </div>
                        <cite class="passport_set" style="display: none"></cite>
                    </dl>
                    <dl>
                        <input id="txtPassword" name="pwd" type="password" placeholder="请输入密码" value="" maxlength="20" /><b></b>
                    </dl>
                    <dl>
                        <input id="code" name="cod" type="text" placeholder="请输入验证码"  maxlength="20" /><b></b>
                        <img src="{{url('/create')}}" id="img" alt="">
                    </dl>
                </li>
            </ul>
            <a id="btnLogin" href="javascript:;" class="orangeBtn loginBtn">登录</a>
        </div>
        <div class="forget">
            <a href="{{url('resetpassword')}}">忘记密码？</a><b></b>
            <a href="{{url('register')}}">新用户注册</a>
        </div>
    </div>
    <div class="oter_operation gray9" style="display: none;">
        
        <p>登录666潮人购账号后，可在微信进行以下操作：</p>
        1、查看您的潮购记录、获得商品信息、余额等<br />
        2、随时掌握最新晒单、最新揭晓动态信息
    </div>
</div>
        
<div class="footer clearfix" style="display:none;">
    <ul>
        <li class="f_home"><a href="/v44/index.do" ><i></i>潮购</a></li>
        <li class="f_announced"><a href="/v44/lottery/" ><i></i>最新揭晓</a></li>
        <li class="f_single"><a href="/v44/post/index.do" ><i></i>晒单</a></li>
        <li class="f_car"><a id="btnCart" href="/v44/mycart/index.do" ><i></i>购物车</a></li>
        <li class="f_personal"><a href="/v44/member/index.do" ><i></i>我的潮购</a></li>
    </ul>
</div>
</body>
</html>
<script>
    $(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //验证用户名
        $('#txtAccount').blur(function () {
            var username=$('#txtAccount').val();
            if(username==''){
                layer.msg('用户名不能为空',{icon:2});
                return false;
            }
        })
        //验证密码
        $('#txtPassword').blur(function () {
            var pwd=$('#txtPassword').val();
            if(pwd==''){
                layer.msg('密码不能为空',{icon:2});
                return false;
            }
        })
        //验证验证码
        $('#code').blur(function () {
            var code=$('#code').val();
            if(code==''){
                layer.msg('验证码不能为空',{icon:2});
                return false;
            }
        })

        //点击更换验证码
        $("#img").click(function(){
            $(this).attr('src',"{{url('/create')}}"+"?"+Math.random())
        })
        
        //点击登录
        $('#btnLogin').click(function () {
            var username=$('#txtAccount').val();
            var pwd=$('#txtPassword').val();
            var code=$('#code').val();
            if(username==''){
                layer.msg('用户名不能为空',{icon:2});
                return false;
            }else if(pwd==''){
                layer.msg('密码不能为空',{icon:2});
                return false;
            }else if(code==''){
                layer.msg('验证码不能为空',{icon:2});
                return false;
            }
            $.ajax({
                method: "get",
                url:"{{url('logincheck')}}",
                data: {username:username,pwd:pwd,code:code},
                async:false,
                dataType:'json'
            }).done(function( res ) {
                  if(res.num==2){
                      layer.msg(res.font,{icon:res.num});
                  }else{
                      layer.msg(res.font,{icon:res.num});
                      setTimeout(function(){
                          location.href = "/";
                      },2000)
                  }
            });
        })
    })

</script>
<script src="/js/all.js"></script>
