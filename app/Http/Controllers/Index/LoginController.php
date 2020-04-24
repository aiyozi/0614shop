<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use App\Mail\Sendemail;
use Illuminate\Support\Facades\Mail;
use App\Member;

class LoginController extends Controller
{
     // 登录
     public function login(){
        return view("index.login");
    }
    public function reg(){
        return view("index.reg");
    }
    // 手机号验证
    public function send(Request $request){
        // 接收账号
        $mobile=request()->mobile;
        $reg='/^1[3|5|8|9]\d{9}$/';
        if(!preg_match($reg,$mobile)){
            echo json_encode(['code'=>"00001","msg"=>"手机号格式错误"]);exit;
        }
        // 获取验证码
        $code=rand(100000,999999);

        $res=$this->sendSms($mobile,$code);
        if($res['Message']=="OK"){
            session(['code'=>$code]);
            request()->session()->save();
            echo json_encode(['code'=>"00000","msg"=>"发送成功"]);exit;
        }
    }
public function sendSms($mobile,$code){
    

    // Download：https://github.com/aliyun/openapi-sdk-php
    // Usage：https://github.com/aliyun/openapi-sdk-php/blob/master/README.md

    AlibabaCloud::accessKeyClient('LTAI4G3UhCRnboGpJtmfW6cL', 'QVy0BbgaAueUIILZRbntPUYMTwBUVh')
                            ->regionId('cn-hangzhou')
                            ->asDefaultClient();

    try {
        $result = AlibabaCloud::rpc()
                            ->product('Dysmsapi')
                            // ->scheme('https') // https | http
                            ->version('2017-05-25')
                            ->action('SendSms')
                            ->method('POST')
                            ->host('dysmsapi.aliyuncs.com')
                            ->options([
                                            'query' => [
                                            'RegionId' => "cn-hangzhou",
                                            'PhoneNumbers' => $mobile,
                                            'SignName' => "小苹果",
                                            'TemplateCode' => "SMS_183241736",
                                            'TemplateParam' => "{code:$code}",
                                            ],
                                        ])
                            ->request();
        return $result->toArray();
    } catch (ClientException $e) {
        return  $e->getErrorMessage() . PHP_EOL;
    } catch (ServerException $e) {
      return $e->getErrorMessage() . PHP_EOL;
    }                   
                   

}
    // 邮箱验证
    public function sendemail(Request $request){
        $email=request()->email;
        // dd($email);
        $em='/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/';
        if(!preg_match($em,$email)){
            echo json_encode(['code'=>"00001","msg"=>"邮箱格式错误"]);exit;
        }
        $code=rand(100000,999999);
        $this->sendbyemail($email,$code);
        session(['code'=>$code]);
        request()->session()->save();
        echo json_encode(['code'=>"00000","msg"=>"发送成功"]);exit;
    }
    public function sendbyemail($email,$code){
        Mail::to($email)->send(new Sendemail($code));
    }
    // 注册
    public function ajax(Request $request){
        $name=request()->name;
        $pwd=request()->pwd;
        $pwdd=request()->pwdd;
        $code=request()->code;
        $co=session("code");
        // dd($co);
        if($name==""){
            echo json_encode(['code'=>"00001","msg"=>"账号不为空"]);exit;
        }else{
            $res=Member::where("mem_name",$name)->first();
            if($res){
                echo json_encode(['code'=>"00001","msg"=>"该账号已有"]);exit;
            }
        }
        $p='/^[A-Za-z0-9]{6,15}$/';
        if($pwd==""){
            echo json_encode(['code'=>"00001","msg"=>"密码不为空"]);exit;
        }else if(!preg_match($p,$pwdd)){
            echo json_encode(['code'=>"00001","msg"=>"密码格式错误"]);exit;
        }
        if($pwdd!=$pwd){
            echo json_encode(['code'=>"00001","msg"=>"确认密码与密码不一致"]);exit;
        }
        if($code!=$co){
            echo json_encode(['code'=>"00001","msg"=>"验证码不一致"]);exit;
        }
        $data=[
            "mem_name"=>$name,
            "mem_pwd"=>$pwd,
            "mem_pwdd"=>$pwdd,
            "code"=>$code,
        ];
        $res=Member::insert($data);
        
        if($res){
            echo json_encode(['code'=>"00000","msg"=>"注册成功"]);exit;
        }else{
            echo json_encode(['code'=>"00001","msg"=>"注册失败"]);exit;
        }
    }
    // 登录
    public function submit(Request $request){
        $post=request()->except(['_token']);
        
        $name=request()->name;
        $pwd=request()->pwd;
        if($name==""){
            echo json_encode(['code'=>"00001","msg"=>"账号不为空"]);exit;
        }
        if($pwd==""){
            echo json_encode(['code'=>"00001","msg"=>"密码不为空"]);exit;
        }
       if(substr_count($name,"@")>0){
        $em='/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/';
        if(!preg_match($em,$name)){
            echo json_encode(['code'=>"00001","msg"=>"邮箱格式错误"]);exit;
        }
       }else{
        $reg='/^1[3|5|8|9]\d{9}$/';
        if(!preg_match($reg,$name)){
            echo json_encode(['code'=>"00001","msg"=>"手机号格式错误"]);exit;
        }
       }
       $where=[
           ['mem_name','=',$name],
           ['mem_pwd','=',$pwd],
       ];
      
       $res=Member::where($where)->first();       
      if($res){
        session(['res'=>$res]);
        request()->session()->save();
        echo json_encode(['code'=>"00000","msg"=>"登录成功"]);exit;
      }else{
        return redirect("/");
      }
       
       
       
    }


}
