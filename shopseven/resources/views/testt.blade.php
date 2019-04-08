<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>redis测试</title>
    <style>
        li{
            float: left;
            list-style: none;
            margin: 1%;
        }
    </style>
    <script src="/js/jquery-3.2.1.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @csrf
</head>
<body>

<div id="ch">
    <input type="text" id="search"><input type="button" value="搜索" id="sea">
    <table>
        @foreach($res as $v)
        <tr>
            <td>商品名称</td>
            <td>{{$v->goods_name}}</td>
        </tr>
        @endforeach
    </table>
    ​{!! $res->appends(['name'=>$name])->render()!!}​
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
        var name=$('#search').val()
        $.ajax({
            method: "POST",
            url:"{{url('indext')}}",
            data:{name:name}
        }).done(function( res ) {
            $('#ch').html(res);
        });
    })
</script>