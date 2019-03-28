
@extends('layout')
@section('title', '猪小妹')
@section('sidebar')
<body fnav="1" class="g-acc-bg">
<meta name="csrf-token" content="{{ csrf_token() }}">
@csrf
    <div class="marginB" id="loadingPicBlock">
        <!--首页头部-->
        <div class="m-block-header" style="display: none">
        	<div class="search"></div>
        	<a href="/" class="m-public-icon m-1yyg-icon"></a>
        </div>
        <!--首页头部 end-->

        <!-- 关注微信 -->
        <div id="div_subscribe" class="app-icon-wrapper" style="display: none;">
            <div class="app-icon">
                <a href="javascript:;" class="close-icon"><i class="set-icon"></i></a>
                <a href="javascript:;" class="info-icon">
                    <i class="set-icon"></i>
                    <div class="info">
                        <p>点击关注666潮人购官方微信^_^</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- 焦点图 -->
        <div class="hotimg-wrapper">
            <div class="hotimg-top"></div>
            <section id="sliderBox" class="hotimg">
        		<ul class="slides" style="width: 600%; transition-duration: 0.4s; transform: translate3d(-828px, 0px, 0px);">
        			<li style="width: 414px; float: left; display: block;" class="clone">
        				<a href="http://weixin.1yyg.com/v27/products/23559.do?pf=weixin">
        					<img src="https://img.alicdn.com/simba/img/TB1T8HJL9rqK1RjSZK9SutyypXa.jpg" alt="">
        				</a>
        			</li>
        			<li class="" style="width: 414px; float: left; display: block;">
        				<a href="http://weixin.1yyg.com/v40/GoodsSearch.do?q=%E5%B0%8F%E7%B1%B36&amp;pf=weixin">
        					<img src="https://aecpm.alicdn.com/simba/img/TB1pi2nLMHqK1RjSZFPSuwwapXa.jpg" alt="https://img.alicdn.com/simba/img/TB1sWx6LZbpK1RjSZFySut_qFXa.jpg">
        				</a>
        			</li>
        			<li style="width: 414px; float: left; display: block;" class="flex-active-slide">
        				<a href="http://weixin.1yyg.com/v40/GoodsSearch.do?q=%E6%B8%85%E5%87%89%E4%B8%80%E5%A4%8F&amp;pf=weixin">
                            <img src="https://img.alicdn.com/tps/i4/TB1.jloLMHqK1RjSZFkSut.WFXa.jpg_1080x1800Q60s50.jpg" alt="">
        				</a>
        			</li>
        			<li style="width: 414px; float: left; display: block;" class="">
        				<a href="http://weixin.1yyg.com/v40/GoodsSearch.do?q=%E6%96%B0%E9%B2%9C%E6%B0%B4%E6%9E%9C&amp;pf=weixin">
                            <img src="https://img.alicdn.com/tps/i4/TB1iBReLmzqK1RjSZFLwu3n2XXa.png_1080x1800Q90.jpg" alt=""></a>
        			</li>
        			<li style="width: 414px; float: left; display: block;" class="">
        				<a href="http://weixin.1yyg.com/v27/products/23559.do?pf=weixin">
        					<img src="https://img.alicdn.com/tfs/TB144JOMgHqK1RjSZJnXXbNLpXa-990-500.jpg_1080x1800Q90s50.jpg" alt="">
        				</a>
        			</li>
        			<li class="clone" style="width: 414px; float: left; display: block;">
        				<a href="http://weixin.1yyg.com/v40/GoodsSearch.do?q=%E5%B0%8F%E7%B1%B36&amp;pf=weixin">
        					<img src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1552736165010&di=5d5400012e3a70a3dd2043a71ff2fb8f&imgtype=0&src=http%3A%2F%2Fpic1.16pic.com%2F00%2F49%2F83%2F16pic_4983642_b.jpg" alt="">
        				</a>
        			</li>
        		</ul>
            </section>
        </div>
        <script>
        	$(function () {  
        		$('.hotimg').flexslider({   
        			directionNav: false,   //是否显示左右控制按钮   
        			controlNav: true,   //是否显示底部切换按钮   
        			pauseOnAction: false,  //手动切换后是否继续自动轮播,继续(false),停止(true),默认true   
        			animation: 'slide',   //淡入淡出(fade)或滑动(slide),默认fade
        			slideshowSpeed: 3000,  //自动轮播间隔时间(毫秒),默认5000ms
        			animationSpeed: 150,   //轮播效果切换时间,默认600ms   
        			direction: 'horizontal',  //设置滑动方向:左右horizontal或者上下vertical,需设置animation: "slide",默认horizontal   
        			randomize: false,   //是否随机幻切换   
        			animationLoop: true   //是否循环滚动  
        		});  
        		setTimeout($('.flexslider img').fadeIn()); 
        	}); 
        </script>
        <!--分类-->
        <div class="index-menu thin-bor-top thin-bor-bottom">

            <ul class="menu-list">
				@foreach($info as $k=>$v)
                <li>
                    <a href="javascript:;" id="btnNew">
                        <i class="xinpin"></i>
                        <input type="hidden" value="{{$v->cate_id}}">
                        <span class="title" >{{$v->cate_name}}</span>
                    </a>
                </li>
				@endforeach
            </ul>

        </div>
        <!--导航-->
        <div class="success-tip">
        	<div class="left-icon"></div>
        	<ul class="right-con">
				<li>
					<span style="color: #4E555E;">
						<a href="./index.php?i=107&amp;c=entry&amp;id=10&amp;do=notice&amp;m=weliam_indiana" style="color: #4E555E;">恭喜<span class="username">啊啊啊</span>获得了<span>iphone7 红色 128G 闪耀你的眼</span></a>
					</span>
				</li>
				<li>
					<span style="color: #4E555E;">
						<a href="./index.php?i=107&amp;c=entry&amp;id=10&amp;do=notice&amp;m=weliam_indiana" style="color: #4E555E;">恭喜<span class="username">啊啊啊</span>获得了<span>iphone7 红色 128G 闪耀你的眼</span></a>
					</span>
				</li>
				<li>
					<span style="color: #4E555E;">
						<a href="./index.php?i=107&amp;c=entry&amp;id=10&amp;do=notice&amp;m=weliam_indiana" style="color: #4E555E;">恭喜<span class="username">啊啊啊</span>获得了<span>iphone7 红色 128G 闪耀你的眼</span></a>
					</span>
				</li>
			</ul>
        </div>

        <!-- 热门推荐 -->
        <div class="line hot">
        	<div class="hot-content">
        		<i></i>
        		<span>最新商品</span>
        		<div class="l-left"></div>
        		<div class="l-right"></div>
        	</div>
        </div>
        <div class="hot-wrapper">
        	<ul class="clearfix">
        		<li style="border-right:1px solid #e4e4e4; ">
        			<a href="">
        				<p class="title">洋河 蓝色经典 海之蓝42度</p>
        				<p class="subtitle">洋河的，棉柔的，口感绵柔浓香型</p>
        				<img src="images/goods2.jpg" alt="">
        			</a>
        		</li>
        		<li>
        			<a href="">
        				<p class="title">洋河 蓝色经典 海之蓝42度</p>
        				<p class="subtitle">洋河的，棉柔的，口感绵柔浓香型</p>
        				<img src="images/goods2.jpg" alt="">
        			</a>
        		</li>
        	</ul>
        </div>
        <!-- 猜你喜欢 -->
        <div class="line guess">
        	<div class="hot-content">
        		<i></i>
        		<span>猜你喜欢</span>
        		<div class="l-left"></div>
        		<div class="l-right"></div>
        	</div>
        </div>
        <!--商品列表-->
        <div class="goods-wrap marginB">
            <ul id="ulGoodsList" class="goods-list clearfix">
				@foreach($data as $v)
            	<li id="23558" codeid="12751965" goodsid="23558" codeperiod="28436">
            		<a href="{{url('goods/shop')}}?goods_id={{$v->goods_id}}" class="g-pic">
            			<img class="lazy" name="goodsImg" src="{{url('/storage/uploads/goosfile/'.$v->goods_img)}}" width="136" height="136">
            		</a>
            		<p class="g-name">{{$v->goods_name}}</p>
            		<ins class="gray9">价值：￥{{$v->self_price}}</ins>
            		<div class="Progress-bar">
            			<p class="u-progress">
            				<span class="pgbar" style="width: 96.43076923076923%;">
            					<span class="pging"></span>
            				</span>
            			</p>
            		</div>
            		<div class="btn-wrap" name="buyBox" limitbuy="0" surplus="58" totalnum="1625" alreadybuy="1567">
            			<a href="javascript:;" id="buy" class="buy-btn" codeid="12751965" goods_id="{{$v->goods_id}}">立即潮购</a>
            			<div class="gRate" codeid="12751965" canbuy="58">
            				<a href="javascript:;"></a>
            			</div>
            		</div>
            	</li>
					@endforeach
            </ul>
        </div>
	</div>
<!--底部-->
<script>
        jQuery(document).ready(function() {
            $("img.lazy").lazyload({
                placeholder : "/images/loading2.gif",
                effect: "fadeIn",
            });
            // 返回顶部点击事件
            $('#div_fastnav #li_menu').click(
                function(){
                    if($('.sub-nav').css('display')=='none'){
                        $('.sub-nav').css('display','block');
                    }else{
                        $('.sub-nav').css('display','none');
                    }

                }
            )
            $("#li_top").click(function(){
                $('html,body').animate({scrollTop:0},300);
                return false;
            });

            $(window).scroll(function(){
                if($(window).scrollTop()>200){
                    $('#li_top').css('display','block');
                }else{
                    $('#li_top').css('display','none');
                }
            })

        });
</script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
           $('.xinpin').click(function () {
               var cate_id=$(this).next().val();
               if(cate_id==''){
                   layer.msg('未选择商品分类',2);
               }else{
                   location.href="{{url('allshops')}}?cate_id="+cate_id;
               }
           })
        $('.buy-btn').click(function () {
            var user_id="{{session('userid')}}";
            if(user_id==''){
                layer.msg('您还未登录，不能购买商品',{icon:2});
                location.href="{{url('login')}}";
                return false;
            }
            var buy_num=1;
            var goods_id=$(this).attr('goods_id');
            $.ajax({
                method: "post",
                url:"{{url('addcart')}}",
                data:{userid:user_id,goods_id:goods_id},
                async:false,
                dataType:'json'
            }).done(function( res ) {
                if(res.num==2){
                    layer.msg(res.font,{icon:res.num});
                }else{
                    layer.msg(res.font,{icon:res.num});
                    setTimeout(function(){
                        location.href = "cart";
                    },2000)
                }
            });
        })

    </script>
@endsection
