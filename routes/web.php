<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
    
//     return view('welcome');
// });
// 必选参数
// Route::get('/good/{id}', function ($id) {
//      return $id;
// });
Route::get("/good/{id}/{name}","IndexController@good")->where(['name'=>'[a-zA-Z\x{4e00}-\x{9fa5}]{3,6}']);

// 可选参数
Route::get('/goods/{id?}/{name}', function ($id=null) {
         return $id;
    });
Route::get("/index","IndexController@index");
Route::post("/doadd","IndexController@doadd");
Route::get("/cpp","IndexController@cpp");

Route::domain("admin.laravel.com")->group(function(){
    // 商品管理
Route::prefix("/brand")->middleware("islogin") ->group(function(){
    Route::get("create","Admin\BrandController@create");
    Route::post("store","Admin\BrandController@store");
    Route::get("/","Admin\BrandController@index");
    Route::get("show/{id}","Admin\BrandController@show");
    Route::get("edit/{id}","Admin\BrandController@edit");
    Route::post("update/{id}","Admin\BrandController@update");
});
// 商品分类
// Route::prefix("/category")->middleware("islogin")->group(function(){
    Route::prefix("/category")->middleware("auth")->group(function(){
    Route::get("create","Admin\CategoryController@create");
    Route::post("store","Admin\CategoryController@store");
    Route::get("/","Admin\CategoryController@index");
    Route::get("edit/{id}","Admin\CategoryController@edit");
    Route::get("show/{id}","Admin\CategoryController@show");
    Route::post("update/{id}","Admin\CategoryController@update");
});
// 商品分类
// Route::prefix("/goods")->middleware("islogin")->group(function(){
    Route::prefix("/goods")->middleware("auth")->group(function(){
    Route::get("create","Admin\GoodsController@create");
    Route::post("store","Admin\GoodsController@store");
    // Route::get("/","Admin\GoodsController@index");
    Route::match(['get','post'],"/","Admin\GoodsController@index");

    Route::get("edit/{id}","Admin\GoodsController@edit");
    Route::get("show/{id}","Admin\GoodsController@show");
    Route::post("update/{id}","Admin\GoodsController@update");
});
// 管理员
Route::prefix("/admin")->middleware("auth")->group(function(){
    Route::get("create","Admin\AdminController@create");
    Route::post("store","Admin\AdminController@store");
    Route::get("/","Admin\AdminController@index");
    Route::get("edit/{id}","Admin\AdminController@edit");
    Route::get("show/{id}","Admin\AdminController@show");
    Route::post("update/{id}","Admin\AdminController@update");
});
// 管理员
Route::prefix("/friendship")->middleware("auth")->group(function(){
    Route::get("create","Admin\FriendshipController@create");
    Route::post("store","Admin\FriendshipController@store");
    Route::get("/","Admin\FriendshipController@index");
    Route::get("edit/{id}","Admin\FriendshipController@edit");
    Route::get("show/{id}","Admin\FriendshipController@show");
    Route::post("update/{id}","Admin\FriendshipController@update");
});
// 登录
Route::prefix("/login")->group(function(){
    Route::get("create","Admin\LoginController@create");
    Route::post("store","Admin\LoginController@store");
    Route::get("end","Admin\LoginController@end");
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

});
Route::domain("www.laravel.com")->group(function(){
    Route::get("/","Index\IndexController@index")->name("shop.index");
    Route::get("login","Index\LoginController@login");
    Route::get("reg","Index\LoginController@reg");
    // 手机号验证
    Route::post("send","Index\LoginController@send");
    // 邮箱验证
    Route::get("sendemail","Index\LoginController@sendemail");
    // 注册
    Route::get("ajax","Index\LoginController@ajax");
    // 登录
    Route::post("submit","Index\LoginController@submit");
    // 详情
    Route::get("goods/{id}","Index\GoodsController@index")->name("shop.goods");
    // 购物车
    Route::get("car","Index\GoodsController@car")->name("shop.car");
    Route::get("addcar","Index\GoodsController@addcar");
    //购物车删除
    Route::get("cardele","Index\GoodsController@cardele");
    // 改购买数量
    Route::get("carget","Index\GoodsController@carget");
    // 添加信息
    Route::get("pay/{id}","Index\GoodsController@pay")->name("shop.pay");
   
    // 详细信息
    Route::get("address","Index\GoodsController@address")->name("shop.address");
});