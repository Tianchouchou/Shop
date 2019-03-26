<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>@yield('title')</title>
    <meta content="app-id=518966501" name="apple-itunes-app" />
    <meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" name="viewport" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <link rel="stylesheet" href="/layui/css/layui.css">
    <link rel="stylesheet" href="/layui/css/layui.css">
    <link href="/css/comm.css" rel="stylesheet" type="text/css" />
    <link href="/css/index.css" rel="stylesheet" type="text/css" />
    <script src="/js/jquery-1.11.2.min.js"></script>
    <script src="/layui/layui.js"></script>
    <script src="/js/all.js"></script>
    <script src="/js/index.js"></script>
    <script src="/js/lazyload.min.js"></script>
    <script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script> <script src="http://cdn.bootcss.com/flexslider/2.6.2/jquery.flexslider.min.js"></script>
    <link href="/css/cartlist.css" rel="stylesheet" type="text/css" />
    <script src="/layui/layui.js"></script>
</head>
<body id="loadingPicBlock" class="g-acc-bg">
@section('sidebar')

@show
<div class="footer clearfix">
    <ul>
        <li class="f_home"><a href="{{url('/')}}" class="hover"><i></i>潮购</a></li>
        <li class="f_announced"><a href="/v41/lottery/" ><i></i>最新揭晓</a></li>
        <li class="f_single"><a href="{{url('allshops')}}" ><i></i>所有商品</a></li>
        <li class="f_car"><a id="btnCart" href="{{url('cart')}}" ><i></i>购物车</a></li>
        <li class="f_personal"><a href="{{url('userpage')}}" ><i></i>我的潮购</a></li>
    </ul>
</div>
<div id="div_fastnav" class="fast-nav-wrapper">
    <ul class="fast-nav">
        <li id="li_menu" isshow="0">
            <a href="javascript:;"><i class="nav-menu"></i></a>
        </li>
        <li id="li_top" style="display: none;">
            <a href="javascript:;"><i class="nav-top"></i></a>
        </li>
    </ul>
    <div class="sub-nav four" style="display: none;">
        <a href="#"><i class="announced"></i>最新揭晓</a>
        <a href="#"><i class="single"></i>晒单</a>
        <a href="#"><i class="personal"></i>我的潮购</a>
        <a href="#"><i class="shopcar"></i>购物车</a>
    </div>
</div>
</body>
</html>