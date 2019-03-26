<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>填写收货地址</title>
    <meta content="app-id=984819816" name="apple-itunes-app" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link href="css/comm.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/writeaddr.css">
    <link rel="stylesheet" href="layui/css/layui.css">
    <link rel="stylesheet" href="dist/css/LArea.css">
</head>
<body>
    
<!--触屏版内页头部-->
<div class="m-block-header" id="div-header">
    <strong id="m-title">填写收货地址</strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="/" class="m-index-icon">首页</a>
</div>
<div class=""></div>
<!-- <form class="layui-form" action="">
  <input type="checkbox" name="xxx" lay-skin="switch">  
  
</form> -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<form class="" action="">
    @csrf
  <div class="addrcon">
    <ul>
      <li>
          <em>收货人</em>
          <input type="text" id="address_name" placeholder="请填写真实姓名">
      </li>
      <li>
          <em>手机号码</em>
          <input type="number" id="address_tel" placeholder="请输入手机号">
      </li>
      <li>
          <em>所在区域</em>
          <select  name="province" class="choose" id="province">
              <option value="">--请选择--</option>
              @foreach($areainfo as $k=>$v)
              <option value="{{$v->id}}">{{$v->name}}</option>
              @endforeach
          </select>
          <select class="choose" id="city">
              <option value="">--请选择--</option>
          </select>
          <select class="choose" id="county">
              <option value="">--请选择--</option>
          </select>
          （必填）
      </li>
      <li class="addr-detail">
          <em>详细地址</em>
          <input type="text"  placeholder="20个字以内" class="address_particular">
      </li>
        <li class="">
            <input type="button" value="提交地址" class="addresssave">
        </li>
    </ul>
  </div>
</form>

<!-- SUI mobile -->
<script src="dist/js/LArea.js"></script>
<script src="dist/js/LAreaData1.js"></script>
<script src="dist/js/LAreaData2.js"></script>
<script src="js/jquery-1.11.2.min.js"></script>
<script src="layui/layui.js"></script>

<script>
  //Demo
layui.use('form', function(){
  var form = layui.form();
  $(document).on('change','choose',function () {
      var _this=$(this);
      var id=_this.val();
      console.log(id);
  })


  //监听提交
  form.on('submit(formDemo)', function(data){
    layer.msg(JSON.stringify(data.field));
    return false;
  });
});

var area = new LArea();
area.init({
    'trigger': '#demo1',//触发选择控件的文本框，同时选择完毕后name属性输出到该位置
    'valueTo':'#value1',//选择完毕后id属性输出到该位置
    'keys':{id:'id',name:'name'},//绑定数据源相关字段 id对应valueTo的value属性输出 name对应trigger的value属性输出
    'type':1,//数据源类型
    'data':LAreaData//数据源
});


</script>
<script>
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on('change','.choose',function () {
            var _this=$(this);
            var id=_this.val();
            var _check="<option value=''>--请选择--</option>";
            if(id==''){
                _this.nextAll('select').html(_check);
                return false;
            }
            $.post(
                "{{url('addressinfo')}}",
                {id:id},
                function(res){
                    //console.log(res);
                    if(res.num==1){
                        for(var i in res['areaInfo']){
                            _check+="<option value="+res['areaInfo'][i]['id']+" >"+res['areaInfo'][i]['name']+"</option>"
                        }
                        _this.next('select').html(_check);
                    }else{
                        layer.msg(res.font,{icon:res.num});
                    }
                },
                'json'
            )
        })

        //点击提交
        $(document).on('click','.addresssave',function () {
            var address_name=$('#address_name').val();
            var address_tel=$('#address_tel').val();
            var province=$('#province').val();
            var city=$('#city').val();
            var county=$('#county').val();
            var address_particular=$('.address_particular').val();
            var user_id="{{session('userid')}}";
            if(address_name==''){
                alert('收货人不能为空');
                return false;
            }else if(address_tel=='')
            {
                alert('电话不能为空');
                return false;
            }
            $.post(
                "{{url('addresssave')}}",
                {address_name:address_name,address_tel:address_tel,province:province,city:city,county:county,address_particular:address_particular,user_id:user_id},
                function(res){
                    if(res==1){
                        alert('添加成功');
                        location.href="{{url('mywallet')}}";
                    }else{
                        alert('添加失败');
                        history.go(0);
                    }

                }
                //'json'
            )

        })
    })
</script>

</body>
</html>
