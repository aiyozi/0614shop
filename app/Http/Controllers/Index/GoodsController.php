<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use App\Cart;
use Illuminate\Support\Facades\Redis;
class GoodsController extends Controller
{
    public function index($id){
        $count=Redis::setnx("visit_".$id,1)?1:Redis::incr("visit_".$id);
        // dd($count);
       $goods= Goods::find($id);
      return view("index.goods",['goods'=>$goods,'count'=>$count]);
    }
    // 购物车
    public function car(){
        $res=session("res");
        if(!$res["mem_name"]){
            return redirect("/login");
       }
        $mem_id=$res->mem_id;
        
        // dd($mem_id);
        $cart=Cart::where("mem_id",$mem_id)->get();
        $buy_num=array_column($cart->toArray(),"buy_num");
        // dd($buy_num);
        $com=array_sum($buy_num);
        // dd($com);
        $cart_id=array_column($cart->toArray(),"cart_id");
        $checked=array_combine($cart_id,$buy_num);
        // dd($checked);
        return view("index.car",['cart'=>$cart,"com"=>$com,'checked'=>$checked]);
    }
    // 购买数量
    public function carget(){
        $res=session("res");
        $mem_id=$res->mem_id;
        // dd($mem_id);
        $buy_num=request()->buy_num;
        $goods_id=request()->goods_id;
        $goods=Goods::where("goods_id",$goods_id)->get();
        $goods_num=array_column($goods->toArray(),"goods_num");
        if($buy_num>=$goods_num){
            $get_num=$goods_num;
            json("1","库存不足");
        }
        $where=[
            ['mem_id','=',$mem_id],
            ['goods_id','=',$goods_id],
        ];
        $res=Cart::where($where)->update(['buy_num'=>$buy_num]);
        if($res){
            json("0","修改成功");
        }else{
            json("1","修改失败");
        }

        // echo $buy_num,"-",$goods_id;
        
    }
    //  删除
    public function cardele(){
        $res=session("res");
        $mem_id=$res->mem_id;
        $cart=Cart::get();
        $cart_id=array_column($cart->toArray(),"cart_id");

        $goods_id=request()->goods_id;
        $where=[
            ["mem_id",'=',$mem_id],
            ["goods_id",'=',$goods_id],
        ];
        $res=Cart::where($where)->delete($cart_id);
        if($res){
            json("0","删除成功");
        }else{
            json("1","删除失败");
        }
    }

    public function addcar(){
        $buy_num=request()->buy_num;
        $goods_id=request()->goods_id;
        $res=session('res');
        
        if(!$res["mem_name"]){
             json("1","请登录");
        }
        $mem_id=$res->mem_id;
        $goods=Goods::select('goods_id','goods_name','goods_img','goods_price','goods_num')->find($goods_id);
        // dd($goods);
        if($buy_num>$goods->goods_num){
            json("2","库存不足");
        }
        $where=[
            "mem_id"=>$mem_id,
            "goods_id"=>$goods_id
        ];
        $cart=Cart::where($where)->first();
        
        if($cart){
            $buy_num=$cart->buy_num+$buy_num;
            if($buy_num>$goods->goods_num){
                $buy_num=$goods->goods_num;
            }
            $res=Cart::where("cart_id",$cart->cart_id)->update(['buy_num'=>$buy_num]);
        }else{
            $data=[
                "mem_id"=>$mem_id,
                "buy_num"=>$buy_num,
                "addtime"=>time()
            ];
            $data=array_merge($data,$goods->toArray());
            unset($data['goods_num']);
            $res=Cart::insert($data);
           }
           
           if($res!==false){
               json("0","成功");
           }
       }
    //    收获信息
     public function pay($id){
        //   
       echo$id;
           $cart=Cart::where("goods_id",$id)->get();

           return view("index.pay",['cart'=>$cart]);
       }
    //    详细信息
    public function address(){
           return view("index.address");
       }
  

    }
