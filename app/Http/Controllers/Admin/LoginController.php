<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Admin;
class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.login.create");
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
        // dump($data['user_pwd']);
        $data['resemer']=request()->post('resemer');
        // dump($data['resemer']);
        
       
        $username=Admin::where('user_name',$data['user_name'])->first();
        // dd($username);
        if(decrypt($username->user_pwd)!=$data['user_pwd']){
            return redirect("/login/create")->with("msg","用户名或密码错误");
        }
        if($data['resemer']==1){
            Cookie::queue("num",serialize($username),24*60*7);
        }
        if($username){
            session(['username'=>$username]);
            return redirect('/brand/create');
        }else{
            return redirect("/login/create")->with("msg","用户名或密码错误");
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function end()
    { 
        request()->session()->forget("username");
        cookie::queue("username",null);
        return redirect("/login/create");
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
