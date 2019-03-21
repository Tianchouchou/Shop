<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>注册</title>
    <meta content="app-id=984819816" name="apple-itunes-app" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link href="/css/comm.css" rel="stylesheet" type="text/css" />
    <link href="/css/login.css" rel="stylesheet" type="text/css" />
    <link href="/css/vccode.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/layui/css/layui.css">
    <script src="/js/jquery-1.11.2.min.js"></script>
</head>
<body>
<meta name="csrf-token" content="{{ csrf_token() }}">
<!--触屏版内页头部-->
<div class="m-block-header" id="div-header">
    <strong id="m-title">注册</strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="/" class="m-index-icon"><i class="m-public-icon"></i></a>
</div>
<div class="wrapper">
    <input name="hidForward" type="hidden" id="hidForward" />
    @csrf
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="registerCon">
        <ul>
            <li class="accAndPwd">
                <dl>
                    <s class="phone"></s>
                    <input id="userMobile" maxlength="11" name='user_tel'type="number" placeholder="请输入您的手机号码" value="" />
                    <span class="clear">x</span>
                </dl>
                <dl>
                    <input type="button" value="获取验证码" id="sendcode">
                </dl>
                <dl>
                    <s class="phone"></s>
                    <input id="security" maxlength="11" name='security'type="text" placeholder="请输入您的验证码" value="" />
                    <span class="clear">x</span>
                </dl>
                <dl>
                    <s class="password"></s>
                    <input class="pwd" maxlength="11" name="user_pwd" type="text" placeholder="6-16位数字、字母组成" value="" />
                    <input class="pwd" maxlength="11" name="user_pwd" type="password" placeholder="6-16位数字、字母组成" value="" style="display: none" />
                    <span class="mr clear">x</span>
                    <s class="eyeclose"></s>
                </dl>
                <dl>
                    <s class="password"></s>
                    <input class="conpwd" maxlength="11" name="user_pwd1" type="text" placeholder="请确认密码" value="" />
                    <input class="conpwd" maxlength="11" name="user_pwd1" type="password" placeholder="请确认密码" value="" style="display: none" />
                    <span class="mr clear">x</span>
                    <s class="eyeclose"></s>
                </dl>
                <dl class="a-set">
                    <i class="gou"></i><p>我已阅读并同意《666潮人购购物协议》</p>
                </dl>

            </li>
            <li><a id="btnNext" href="javascript:;" class="orangeBtn loginBtn">下一步</a></li>
        </ul>
    </div>


    <div class="footer clearfix" style="display:none;">
        <ul>
            <li class="f_home"><a href="/v44/index.do" ><i></i>云购</a></li>
            <li class="f_announced"><a href="/v44/lottery/" ><i></i>最新揭晓</a></li>
            <li class="f_single"><a href="/v44/post/index.do" ><i></i>晒单</a></li>
            <li class="f_car"><a id="btnCart" href="/v44/mycart/index.do" ><i></i>购物车</a></li>
            <li class="f_personal"><a href="/v44/member/index.do" ><i></i>我的云购</a></li>
        </ul>
    </div>
    <div class="layui-layer-move"></div>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="/layui/layui.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.registerCon input').bind('keydown',function(){
            var that = $(this);
            if(that.val().trim()!=""){

                that.siblings('span.clear').show();
                that.siblings('span.clear').click(function(){
                    console.log($(this));

                    that.parents('dl').find('input:visible').val("");
                    $(this).hide();
                })

            }else{
                that.siblings('span.clear').hide();
            }

        })
        function show(){
            if($('.registerCon input').attr('type')=='password'){
                $(this).prev().prev().val($("#passwd").val());
            }
        }
        function hide(){
            if($('.registerCon input').attr('type')=='text'){
                $(this).prev().prev().val($("#passwd").val());
            }
        }
        $('.registerCon s').bind({click:function(){
                if($(this).hasClass('eye')){
                    $(this).removeClass('eye').addClass('eyeclose');

                    $(this).prev().prev().prev().val($(this).prev().prev().val());
                    $(this).prev().prev().prev().show();
                    $(this).prev().prev().hide();


                }else{
                    console.log($(this  ));
                    $(this).removeClass('eyeclose').addClass('eye');
                    $(this).prev().prev().val($(this).prev().prev().prev().val());
                    $(this).prev().prev().show();
                    $(this).prev().prev().prev().hide();

                }
            }
        })

        function registertel(){
            // 手机号失去焦点
            $('#userMobile').blur(function(){
                reg=/^1(3[0-9]|4[57]|5[0-35-9]|8[0-9]|7[06-8])\d{8}$/;//验证手机正则(输入前7位至11位)
                var that = $(this);
                if( that.val()==""|| that.val()=="请输入您的手机号")
                {
                    layer.msg('请输入您的手机号！',{icon:2});
                } else if(that.val().length<11)
                {
                    layer.msg('您输入的手机号长度有误！',{icon:2});
                } else if(!reg.test($("#userMobile").val()))
                {
                    layer.msg('您输入的手机号不存在!',{icon:2});
                } else if(that.val().length == 11){
                    // ajax请求后台数据
                    var tel=that.val();
                    $.ajax({
                        method: "POST",
                        url: "checktel",
                        data: {tel:tel },
                        async:false,
                        dataType:"json"
                    }).done(function( res ) {
                        layer.msg(res.font,{icon:res.num});
                    });
                }
            })
            // 密码失去焦点
            $('.pwd').blur(function(){
                reg=/^[0-9a-zA-Z]{6,16}$/;
                var that = $(this);
                if( that.val()==""|| that.val()=="6-16位数字或字母组成")
                {
                    layer.msg('请设置您的密码！',{icon:2});
                }else if(!reg.test($(".pwd").val())){
                    layer.msg('请输入6-16位数字或字母组成的密码!',{icon:2});
                }
            })

            // 重复输入密码失去焦点时
            $('.conpwd').blur(function(){
                var that = $(this);
                var pwd1 = $('.pwd').val();
                var pwd2 = that.val();
                if(pwd1!=pwd2){
                    layer.msg('您两次输入的密码不一致哦~~',{icon:2});
                }
            })
        }
        //发送验证码
        $('#sendcode').click(function () {
            var tel=$('#userMobile').val();
            if(tel==''){
                layer.msg('手机号不能为空哦~~',{icon:2});
                return false;
            }
            $.post(
                "sendinfo",
                {tel:tel},
                function(res){
                }
            )
        })
        //验证码失去焦点时
        $('#security').blur(function(){
            var code=$('#security').val();
            if(code==''){
                layer.msg('手机号验证码不能为空哦~~',{icon:2});
                return  false;
            }
            $.ajax({
                method: "POST",
                url: "codecheck",
                data: {code:code },
                async:false,
                dataType:'json'
            }).done(function( msg ) {
                layer.msg(msg.font,{icon:msg.num});
                });

        })
        registertel();
        // 购物协议
        $('dl.a-set i').click(function(){
            var that= $(this);
            if(that.hasClass('gou')){
                that.removeClass('gou').addClass('none');
                $('#btnNext').css('background','#ddd');

            }else{
                that.removeClass('none').addClass('gou');
                $('#btnNext').css('background','#f22f2f');
            }

        })
        // 下一步提交
        $('#btnNext').click(function(){
            if($('#userMobile').val()==''){
                layer.msg('请输入您的手机号！',{icon:2});
                return false;
            }else if($('.pwd').val()==''){
                layer.msg('请输入您的密码!',{icon:2});
                return false;
            }else if($('.conpwd').val()==''){
                layer.msg('请您再次输入密码！',{icon:2});
                return false;
            }else if($('#security').val()==''){
                layer.msg('请输入验证码！',{icon:2});
                return false;
            }
            var user_tel=$('#userMobile').val();
            var user_pwd=$('.pwd').val();
            var user_pwd1=$('.conpwd').val();
            var code=$('#security').val();
            $.post(
                "{{url('add')}}",
                {user_tel:user_tel,user_pwd:user_pwd,user_pwd1:user_pwd1,code:code},
                function(res){
                    layer.msg(res.font,{icon:res.num});
                    if(res.num == 1){
                        setTimeout(function(){
                            location.href = "/";
                        },2000)
                    }
                },
                'json'
            )
        })


    </script>
    <script src="/js/all.js"></script>
</body>
</html>
