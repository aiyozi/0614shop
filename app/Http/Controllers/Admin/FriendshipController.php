<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Friendship;
class FriendshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $frie_name=request()->frie_name;
        $where=[];
        if($frie_name){
            $where[]=["frie_name",'like',"%$frie_name%"];
        }
        $pagsize=config("app.PageSize");
        $res=Friendship::where($where)->paginate($pagsize);
        return view("admin.friendship.index",['res'=>$res,'frie_name'=>$frie_name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.friendship.create");
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
            "frie_name"=>"required|unique:friendship|max:10|regex:/^[\x{4e00}-\x{9fa5}\w]{3,20}$/u",
            "frie_desc"=>"required",
            "frie_names"=>"required|regex:/^[\x{4e00}-\x{9fa5}\w]{3,20}$/u",
            "frie_url"=>"required",
           
        ],[
            "frie_name.required"=>"网址名称必填",
            "frie_name.unique"=>"网址名称已有",
            "frie_name.max"=>"网址名称最大10位",
            "frie_name.regex"=>"网址名称中文，字母，数字组成",
            "frie_desc.required"=>"商品介绍必填",
            "frie_names.required"=>"网址联系人必填",
            "frie_names.required"=>"网址联系人必须是中文",
            "frie_url.required"=>"网址必填",
        ]);
        if($request->hasFile("frie_logo")){
            $data['frie_logo']=upload("frie_logo");
        }
        $res=Friendship::insert($data);
        if($res){
            return redirect("/friendship");
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
        $res=Friendship::find($id);
        return view("admin.friendship.show",['res'=>$res]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $res=Friendship::destroy($id);
       if($res){
        return redirect("/friendship");
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
        if($request->hasFile("frie_logo")){
            $data['frie_logo']=upload("frie_logo");
        }
        $res=Friendship::where("frie_id",$id)->update($data);
        if($res){
            return redirect("/friendship");
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
