<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ha;
use Illuminate\Support\Facades\Cache;
class IndexController extends Controller
{
    public function index(){
        return view("index");
    }
    public function doadd(){
        $data=request()->except(['_token']);
        $res=Ha::insert($data);
        if($res){
           return  redirect("/cpp");
        }
    }
    public function cpp(){
             // 取缓存
             $name=Cache::get("name");
             dump($name);
            if(!$name){
                echo"空的";
                $name=request()->name;
             // 存缓存
             Cache::put("name",$name,30);
            }
        $where=[];
        if($name){
            $where[]=["name","like","%$name%"];
        }
     
        $res=Ha::where($where)->paginate(2);
        return view("cpp",['res'=>$res,'name'=>$name]);
    }
    // 必选参数
    public function good($id,$name){
        echo$id;
        echo$name;
    }
    // 可选参数
    public function goods($id,$name){
        echo$id;
        echo$name;
    }
}
