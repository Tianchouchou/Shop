<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>测试</title>
    <style>
        li{
            float: left;
            list-style: none;
            margin: 1%;
        }
        tr{
            border: black solid 1px;
            border-collapse: collapse;
        }
        td{
            border: black solid 1px;
            border-collapse: collapse;
        }
    </style>
    <script src="/js/jquery-3.2.1.min.js"></script>
</head>
<body>
<meta name="csrf-token" content="{{ csrf_token() }}">
@csrf

<div id="yemian">
    <input type="text" id="search"><input type="button" value="搜索" id="sea">
    <table >
        @foreach($res as $k)
        <tr>
            <td>商品名称</td>
            <td>{{$k->goods_name}}</td>
        </tr>
        <tr>
            <td>商品售价</td>
            <td>{{$k->self_price}}</td>
        </tr>
         @endforeach
    </table>
    ​{!! $res->appends(['search'=>$search])->render()!!}​
</div>
</body>
</html>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#sea').click(function () {
        var search=$('#search').val();
        $.ajax({
              method: "POST",
              url:"{{url('index')}}",
              data:{search:search}
        }).done(function( res ) {
             $('#yemian').html(res);
            });

    })
</script>