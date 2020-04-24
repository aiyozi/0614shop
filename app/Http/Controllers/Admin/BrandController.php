<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Brand;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 展示页面
        $brand_name=request()->brand_name;
        $where=[];
        if($brand_name){
            $where[]=["brand_name",'like',"%$brand_name%"];
        }
        $pagsize=config("app.PageSize");
        $res=Brand::orderBy("brand_id","desc")->where($where)->paginate($pagsize);
        // dd($res);
        return view("admin.brand.index",['res'=>$res,"brand_name"=>$brand_name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //展示页面
        return view("admin.brand.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 接收数据 except 排除 only只接受谁
        
       $data=$request->validate([
           "brand_name"=>"required|unique:brand|max:10",
           "brand_url"=>"required",
           "brand_desc"=>"required",
       ],[
           "brand_name.required"=>"品牌名称必填",
           "brand_name.unique"=>"品牌名称已有",
           "brand_name.max"=>"品牌名称最大10位",
           "brand_url.required"=>"品牌网址必填",
           "brand_desc.required"=>"品牌介绍必填",
       ]);
        // dd($data);
        // 文件上传
        if($request->hasFile("logo")){
            $data['logo']=upload("logo");
        }
        $res=Brand::insert($data);
        if($res){
            return redirect("/brand");
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
        $res=Brand::destroy($id);
        if($res){
            return redirect("/brand");
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //修改展示
        $res=Brand::find($id);
        return view("admin.brand.edit",['res'=>$res]);
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
        //修改
        $data=request()->except(['_token']);
        if(request()->hasFile("logo")){
            $data['logo']=upload("logo");
        }
        $res=Brand::where("brand_id",$id)->update($data);
        if($res!==false){
            return redirect("/brand");
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
