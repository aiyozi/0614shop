@extends("layouts.shop")
     @section("title",'注册')
     @section('content')
     <meta name="csrf-token" content="{{ csrf_token() }}">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <form action="user.html" method="get" class="reg-login">
     @csrf
     <input type="hidden" name="refer"  id="refer" value="{{request()->refer}}">
      <h3>还没有三级分销账号？点此<a class="orange" href="{{url('/reg')}}">注册</a></h3>
      <div class="lrBox">
       <div class="lrList"><input type="text" id="name" placeholder="输入手机号码或者邮箱号" /></div>
       <div class="lrList"><input type="password" id="pwd" placeholder="输入密码" /></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="" id="submit" value="立即登录" />
      </div>
     </form><!--reg-login/-->
     <script>  
          // 给登录一个点击事件
          $(document).on("click","#submit",function(){
               var name=$("#name").val();
               var pwd=$("#pwd").val();
               var refer=$("#refer").attr("value");
               if(name==""){
                    alert("前账号非空");
                    return;
               }
               if(pwd==""){
                    alert("前密码非空");
               }
               $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
               $.post('submit',{name:name,refer:refer,pwd:pwd},function(res){
                    if(res.code=="00000"){
                         location.href="{{url('/')}}";
                         alert(res.msg);
                    }else{
                         alert(res.msg);;
                    }
               },'json');
          })
     
     
     </script>
     @endsection
 