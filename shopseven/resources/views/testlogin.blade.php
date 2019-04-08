<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>登陆</title>
    <script src="/js/jquery-3.2.1.min.js"></script>
</head>
<body>
        <table>
            <tr>
                <td>用户名</td>
                <td><input type="text" id="username"></td>
            </tr>
            <tr>
                <td>密码</td>
                <td><input type="password" id="pwd"></td>
            </tr>
            <tr>
                <td><input type="button" value="登陆" id="tj"></td>
                <td><a href="{{url('changepwd')}}">修改密码</a></td>
            </tr>
        </table>
        <meta name="csrf-token" content="{{ csrf_token() }}">
@csrf
</body>
</html>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#tj').click(function () {
        var username=$('#username').val();
        var pwd=$('#pwd').val();
        if(username==''){
            alert('用户名不能为空');
            return false;
        }else if (pwd==''){
            alert('密码不能为空');
            return false;
        }
        $.ajax({
              method: "POST",
              async:false,
              url: "{{url('indexb')}}",
              data: {username:username,pwd:pwd}
        }).done(function( res ) {
              console.log(res);
            });


    })
</script>