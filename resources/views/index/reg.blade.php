
@extends("layouts.shop")
     @section("title",'登录')
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
     <form action="login.html" method="get" class="reg-login">
      <h3>已经有账号了？点此<a class="orange" href="{{url('/login')}}">登陆</a></h3>
      <div class="lrBox">
       <div class="lrList"><input type="text" name="name" id="name" placeholder="输入手机号码或者邮箱号" /></div>
       <div class="lrList2"><input type="text" id="code" placeholder="输入短信验证码" /> <button type="button">获取验证码</button></div>
       <div class="lrList"><input type="password" id="pwd" placeholder="设置新密码（6-18位数字或字母）" /></div>
       <div class="lrList"><input type="password" id="pwdd" placeholder="再次输入密码" /></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="javascripy:;" id="submit" value="立即注册" />
      </div>
     </form><!--reg-login/-->
     <script>
     // 给发送一个点击事件
          $(document).on("click","button",function(){
               var name=$("#name").val();
               var reg=/^1[3|5|6|8|9]\d{9}$/;
               if(name==""){
                    alert("手机号或邮箱不为空");
                    return;
               }
                     	// 获取秒数倒计时
		var t=$("button").text("20s");
		t=setInterval(timeLess,1000);
               if(reg.test(name)){
                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
               $.post("send",{mobile:name},function(res){
                  alert(res.msg);
               },'json');
               return;
               }
              
               var  email=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
               if(email.test(name)){
                    $.get("sendemail",{email:name},function(res){
                  alert(res.msg);
               },'json');
               return;
               }
         
		// setInterval开启秒数倒计时
               alert("请输入正确的手机号或邮箱");

                  //定时器获取秒数
			function timeLess(){
				// 获取秒数
				var s=$("button").text();
				// console.log(s);
				// 将秒数转化为数子类型
				s=parseInt(s);
				
				// console.log(s);
				// 让秒数不一直减
				if(s<=0){
				$("button").text("获取验证码");
				// 关闭定时器
				clearInterval(t);
				//当获取的是侯让点击获取
				$("button").css('pointer-events','auto');
				}else{
					// 将秒数减1
				s=s-1;
				// console.log(s);
				$("button").text(s+'s');
				// 不让点击秒数
				$("button").css('pointer-events','none');
					}
				}
          })
       
          // 给注册一个点击事件
          $(document).on("click","#submit",function(res){
               var name=$("#name").val();
               var pwd=$("#pwd").val();
               var code=$("#code").val();
               var pwdd=$("#pwdd").val();
               if(name==""){
                    alert("账号不为空");
                    return;
               }

               var p=/^[A-Za-z0-9]{6,15}$/;
               if(pwd==""){
                    alert("密码必填");
                    return;
               }else if(!p.test(pwd)){
                    alert("密码最少六位最多15位");
                    return;
               }
               if(pwdd!=pwd){
                    alert("确认密码与密码不一致");
                    return;
               }
               $.get("ajax",{name:name,pwd:pwd,code:code,pwdd:pwdd},function(res){
                    if(res.code=="00000"){
                         location.href="{{url('/login')}}";
                         alert(res.msg);
                    }else{
                         alert(res.msg);;
                    }
               },'json')
          })
     </script>
     @endsection
    