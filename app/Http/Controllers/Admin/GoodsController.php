<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Brand;
use App\Goods;
class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $goods_name=request()->goods_name;
        $where=[];
        if($goods_name){
            $where[]=["goods_name",'like',"%$goods_name%"];
        }
        $PageSize=config("app.PageSize");
        $brand=Brand::all();
        $cate=Category::all();
        $goods=Goods::where($where)
        ->leftjoin("brand","goods.brand_id",'=',"brand.brand_id")
        ->leftjoin("category","goods.cart_id",'=','category.cart_id')
        ->paginate($PageSize);
        // dd($goods);
        if(request()->ajax){
        return view("admin.goods.ajax",['goods'=>$goods,"goods_name"=>$goods_name]);

        }else{
        return view("admin.goods.index",['goods'=>$goods,"goods_name"=>$goods_name]);

        }
    }
  
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $brand=Brand::all();
        $cate=Category::all();
        $cate=getcateinfo($cate);
       
        return view("admin.goods.create",['brand'=>$brand,'cate'=>$cate]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=request()->except(['_token']);
        $request->validate([
            "goods_name"=>"required|unique:goods|max:10",
            "goods_desc"=>"required",
            "goods_price"=>"required",
            "goods_num"=>"required",
            "goods_hao"=>"required",
            "goods_score"=>"required",
        ],[
            "goods_name.required"=>"商品名称必填",
            "goods_name.unique"=>"商品名称已有",
            "goods_name.max"=>"商品名称最大10位",
         
            "goods_desc.required"=>"商品介绍必填",
            "goods_price.required"=>"商品价格必填",
            "goods_num.required"=>"商品库存必填",
            "goods_hao.required"=>"商品货号必填",
            "goods_score.required"=>"商品积分必填",
        ]);
        if($request->hasFile("goods_img")){
            $data['goods_img']=upload("goods_img");
        }
        if($request->hasFile("goods_imgs")){
            $data['goods_imgs']=Maxupload("goods_imgs");
            $data['goods_imgs']=implode("|",$data['goods_imgs']);
        }
        
        $res=Goods::insert($data);
        if($res){
            return redirect("/goods");
        }
    }
  
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $brand=Brand::all();
        $cate=Category::all();
        $res=Goods::find($id);
        return view("admin.goods.show",['res'=>$res,'brand'=>$brand,"cate"=>$cate]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $res=Goods::destroy($id);
        if($res){
            return redirect("/goods");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data=request()->except(['_token']);
        if($request->hasFile("goods_img")){
            $data['goods_img']=upload("goods_img");
        }
        if($request->hasFile("goods_imgs")){
            $data['goods_imgs']=Maxupload("goods_imgs");
            $data['goods_imgs']=implode("|",$data['goods_imgs']);
        }
        $res=Goods::where("goods_id",$id)->update($data);
        if($res!==false){
            return redirect("/goods");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
