<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res=Admin::all();
        return view("admin.admin.index",['res'=>$res]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.admin.create");
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
       $data['time']=time();
       
        $request->validate([
            "user_name"=>"required|unique:admin|regex:/^[\x{4e00}-\x{9fa5}\w]{3,20}$/u",
            "user_tel"=>"required|max:11",
            "user_email"=>"required|unique:admin|regex:/^\d{4}@\w{2,5}.com$/i",
            "user_pwd"=>"required|regex:/^[A-Za-z0-9]{6,20}$/",
            "user_pwdd"=>"required|same:user_pwd",
        ],[
          "user_name.required"=>"用户名称必填",
          "user_name.unique"=>"用户名已有",
          "user_name.regex"=>"由中文。字母。下划线最少三位最多20位",
          "user_tel.required"=>"手机号必填",
          "user_tel.max"=>"手机号11位",
          "user_email.required"=>"邮箱必填",
          "user_email.unique"=>"邮箱已有",
          "user_email.regex"=>"邮箱格式错误",
          "user_pwd.required"=>"密码必填",
          "user_pwd.regex"=>"密码6-20位",
            "user_pwdd.required"=>"确认密码必填",
            "user_pwdd.same"=>"确认密码与密码一致",
        ]); 
       
           
        
        $data['user_pwd']=(encrypt($data['user_pwd']));
        $res=Admin::where($data['user_pwd']==$data['user_pwdd'])->insert($data);
        if($res){
            return redirect("/admin");
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
        $res=Admin::find($id);
        return view("admin.admin.show",['res'=>$res]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $res=Admin::destroy($id);
        if($res){
            return redirect("/admin");
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
        $res=Admin::where("user_id",$id)->update($data);
        if($res){
            return redirect("/admin");
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
