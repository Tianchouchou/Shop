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
    return view('Index',['data'=>$res]);
});

//路由组
Route::prefix('/')->group(function () {

    //我的潮购
    route::any('userpage','Shop\LoginController@userpages');
    //购物车
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
});

//验证码路由
route::any('create','CodeController@create');

Route::any('/goods/shop','GoodsController@shopcontent');

