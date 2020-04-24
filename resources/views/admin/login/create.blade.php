<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>品牌</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      <tton>
      <a class="navbar-brand" href="#">后台</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="{{url('/brand/create')}}">品牌管理</a><>
        <li><a href="{{url('/category/create')}}">分类管理</a><>
        <li><a href="{{url('/goods/create')}}">商品管理</a><>
        <li><a href="{{url('/admin/create')}}">管理员</a><>
      </ul>
    </div>
  </div>
</nav>

<center><h2>管理员登录页面</h2></center><br>
<form action="{{url('login/store')}}" method="post" class="form-horizontal" role="form" >
@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">用户名称</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="user_name" id="firstname" 
				   placeholder="请输入用户名称">
                   
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">用户密码</label>
		<div class="col-sm-8">
			<input type="password" class="form-control" name="user_pwd" id="firstname" 
				   placeholder="请输入用户密码">
                   <font color="red">{{session("msg")}}</font>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否记住密码</label>
		<div class="col-sm-8">
			<input type="checkbox" class="form-control" name="resemer" value="1"
				   placeholder="请输入用户密码">
                   
		</div>
	</div>
   
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">登录<tton>
		</div>
	</div>
</form>

</body>
<ml>
