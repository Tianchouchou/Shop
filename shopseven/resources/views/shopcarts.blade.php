@extends('layout')
@section('title', '购物车')
@section('sidebar')
    <script src="js/jquery-1.11.2.min.js"></script>
    <script src="js/lazyload.min.js"></script>
    <script src="js/mui.min.js"></script>
    <link href="/css/cartlist.css" rel="stylesheet" type="text/css" />
    <body id="loadingPicBlock" class="g-acc-bg">
    <input name="hidUserID" type="hidden" id="hidUserID" value="-1" />
    <div>
        <!--首页头部-->
        <div class="m-block-header">
            <a href="/" class="m-public-icon m-1yyg-icon"></a>
            <a href="/" class="m-index-icon">编辑</a>
        </div>
        <!--首页头部 end-->
        <div class="g-Cart-list">
            <div id="divNone" class="empty "  style="display: none"><s></s><p>您的购物车还是空的哦~</p><a href="https://m.1yyg.com" class="orangeBtn">立即潮购</a></div>
        </div>
        <div id="mycartpay" class="g-Total-bt g-car-new" style="">
            <dl>
                <dt class="gray6">
                    <s class="quanxuan current"></s>全选
                    <p class="money-total">合计<em class="orange total"><span>￥</span>17.00</em></p>

                </dt>
                <dd>
                    <a href="javascript:;" id="a_payment" class="orangeBtn w_account remove">删除</a>
                    <a href="javascript:;" id="a_payment" class="orangeBtn w_account">去结算</a>
                </dd>
            </dl>
        </div>

        <div class="footer clearfix">
            <ul>
                <li class="f_home"><a href="/v41/index.do" ><i></i>潮购</a></li>
                <li class="f_announced"><a href="/v41/lottery/" ><i></i>最新揭晓</a></li>
                <li class="f_single"><a href="/v41/post/index.do" ><i></i>晒单</a></li>
                <li class="f_car"><a id="btnCart" href="/v41/mycart/index.do" class="hover"><i></i>购物车</a></li>
                <li class="f_personal"><a href="/v41/member/index.do" ><i></i>我的潮购</a></li>
            </ul>
        </div>
        @csrf
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="js/jquery-1.11.2.min.js"></script>
        <!---商品加减算总数---->
        <script type="text/javascript">
            $(function () {
                $(".add").click(function () {
                    var t = $(this).prev();
                    t.val(parseInt(t.val()) + 1);
                    GetCount();
                })
                $(".min").click(function () {
                    var t = $(this).next();
                    if(t.val()>1){
                        t.val(parseInt(t.val()) - 1);
                        GetCount();
                    }
                })
            })
        </script>
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // 全选
            $(".quanxuan").click(function () {
                if($(this).hasClass('current')){
                    $(this).removeClass('current');

                    $(".g-Cart-list .xuan").each(function () {
                        if ($(this).hasClass("current")) {
                            $(this).removeClass("current");
                        } else {
                            $(this).addClass("current");
                        }
                    });
                    GetCount();
                }else{
                    $(this).addClass('current');

                    $(".g-Cart-list .xuan").each(function () {
                        $(this).addClass("current");
                        // $(this).next().css({ "background-color": "#3366cc", "color": "#ffffff" });
                    });
                    GetCount();
                }


            });
            // 单选
            $(".g-Cart-list .xuan").click(function () {
                if($(this).hasClass('current')){


                    $(this).removeClass('current');

                }else{
                    $(this).addClass('current');
                }
                if($('.g-Cart-list .xuan.current').length==$('#cartBody li').length){
                    $('.quanxuan').addClass('current');

                }else{
                    $('.quanxuan').removeClass('current');
                }
                // $("#total2").html() = GetCount($(this));
                GetCount();
                //alert(conts);
            });
            // 已选中的总额
            function GetCount() {
                var conts = 0;
                var aa = 0;
                $(".g-Cart-list .xuan").each(function () {
                    if ($(this).hasClass("current")) {
                        for (var i = 0; i < $(this).length; i++) {
                            conts += parseInt($(this).parents('li').find('input.text_box').val());
                            // aa += 1;
                        }
                    }
                });

                $(".total").html('<span>￥</span>'+(conts).toFixed(2));
            }

            $('.z-del').click(function () {
                var _this=$(this);
                var user_id="{{session('userid')}}";
                var goods_id=_this.prev('.goods_id').val();
                if(goods_id==''){
                    alert('您未选择商品');
                }
                $.post(
                    "{{'goodsdel'}}",
                    {goods_id:goods_id,user_id:user_id},
                    function (res) {
                        layer.msg(res.font,{icon:res.num});
                        history.go(0)
                    },
                    'json'
                )
            })
            GetCount();
        </script>
    </div>
    </body>
@endsection
