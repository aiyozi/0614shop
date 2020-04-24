<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
class IndexController extends Controller
{
    // 首页
    public function index(){
        // 取缓存
        // $slide=Cache::get("slide");
        // 使用REDIS取值
        // Redis::del("slide");
        // $slide=Redis::get("slide");
        $slide=cache("slide");
        // dump($slide);
       if(!$slide){
        //    echo"空的";
        $slide=Goods::getlist();
        // 存缓存
        // Cache::put("slide",$slide,30);
        cache(['slide'=>$slide,30]);
        // 存数据库
        // Redis::setex("slide",60,$slide);
       }
    //    $slide=unserialize($slide);
        return view("index.index",['slide'=>$slide]);
    }
   
}
