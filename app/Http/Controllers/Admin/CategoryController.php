<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cate=Category::get();
        $cate=$this->getcateinfo($cate);
        return view("admin/category.index",['cate'=>$cate]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cate=Category::get();
        $cate=$this->getcateinfo($cate);
        return view("admin.category.create",['cate'=>$cate]);
    }
    public function getcateinfo($data,$prent_id=0,$level=0){
        // 判断如果￥data没有值直接返回
        if(!$data){
            return;
        }
        static $na=[];
        // 有数据foreach
        foreach($data as $v){
            // 判断祖先及分类是否相等
            if($v->prent_id==$prent_id){
                // 如果相当给他增加层级关系
                $v->level=$level;
                $na[]=$v;
                // $data相当于$cate    $v->cart_name是祖先级分类下的子孙级  $level是层级关机+1
                $this->getcateinfo($data,$v->cart_id,$level+1);
            }
        }
        return $na;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data=request()->except(['_token']);
        // dd($data);
        $res=Category::insert($data);
      if($res){
          return redirect("/category");
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
        $res=Category::find($id);
        $cate=Category::get();
        $cate=$this->getcateinfo($cate);
        return view("admin.category.show",['cate'=>$cate,'res'=>$res]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $res=Category::destroy($id);
        if($res){
            return redirect("/category");
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
        //
        $data=request()->except(['_token']);
        $res=Category::where("cart_id",$id)->update($data);
        if($res){
            return redirect("/category");
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
