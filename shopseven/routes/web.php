<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $res= \App\Model\Goods::get();
    $info= \App\Model\CategoryModel::where(['pid'=>0])->limit(5)->get();
    return view('Index',['data'=>$res,'info'=>$info]);
});

//路由组
Route::prefix('/')->group(function () {
    //我的潮购
    route::any('userpage','Shop\LoginController@userpages');
    //购物车展示
    route::any('cart','Shop\LoginController@shopcart');
    //登陆
    Route::any('login',function (){
        return view('login');
    });
    Route::any('shopcart',function(){
        return view('shopcart');
    });
    //所有商品
    route::any('allshops','Shop\UserController@show');
    //注册
    Route::any('register',function (){
        return view('register');
    });
    //忘记密码
    Route::any('resetpassword',function (){
        return view('resetpassword');
    });
    route::any('add','Shop\UserController@add');//
    //查询子类商品
    route::any('searchson','Shop\UserController@searchson');
    //查询子类商品
    route::any('checktel','Shop\UserController@checktel');
    //发送验证码
    route::any('sendinfo','Shop\LoginController@sendMobile');
    //手机验证码检查
    route::any('codecheck','Shop\LoginController@codecheck');
    //账号登陆检查
    route::any('logincheck','Shop\LoginController@logincheck');
    //添加购物车
    route::any('addcart','Shop\LoginController@addcart');
    //购物车单个商品删除
    route::any('goodsdel','Shop\LoginController@goodsdel');
    //购物车页面没有数据
    route::any('shopcarts','Shop\LoginController@shopcarts');
    //收货地址展示
    route::any('mywallet','Shop\LoginController@mywallet');
    //收货地址添加
    route::any('addressad','Shop\LoginController@addressad');
    //收货地址添加数据
    route::any('addressinfo','Shop\LoginController@addressinfo');
    //收货地址数据添加
    route::any('addresssave','Shop\LoginController@addresssave');
    //设置默认修改
    route::any('setinfo','Shop\LoginController@setinfo');
    //删除地址
    route::any('delinfo','Shop\LoginController@delinfo');
    //结账
    route::any('accounts','Shop\LoginController@accounts');
    //确认结算
    route::any('payment','Shop\LoginController@payment');
    //搜索
    route::any('search','Shop\LoginController@search');
    //搜索结果展示
    route::any('searchshow','Shop\LoginController@searchshow');
    //沙箱异步
    route::any('yi','Shop\LoginController@yi');
    //沙箱同步
    route::any('tong','Shop\LoginController@tong');
    //沙箱支付
    route::any('show','PayController@shows');
    //加号减号改变库存
    route::any('changenum','Shop\LoginController@changenum');
    //保存access_token
    route::any('savetoken','WeixinController@savetoken');
});

//验证码路由
route::any('create','CodeController@create');
//商品详情
Route::any('/goods/shop','GoodsController@shopcontent');

//memcached
Route::any('index','TestController@index');

//redios
Route::any('indext','TestController@indext');
//redisB
Route::any('indexb','TestController@indexb');
//redisB
Route::any('changepwd','TestController@changepwd');