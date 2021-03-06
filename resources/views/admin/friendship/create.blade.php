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
		<li><a href="{{url('/friendship/create')}}">友情连接</a><>
      </ul>
    </div>
  </div>
</nav>

<center><h2>友情连接页面<a href="{{url('/friendship')}}" style="float:right" class="btn btn-default">列表</a></h2></center><br>
<form action="{{url('friendship/store')}}" method="post" class="form-horizontal" role="form"enctype="multipart/form-data"  >
@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">网址名称</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="frie_name" id="firstname" 
				   placeholder="请输入网址名称">
                   <font color="red">{{$errors->first("frie_name")}}</font>
		</div>
	</div>
  <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">网站网址</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="frie_url" id="firstname" 
				   placeholder="请输入网址名称">
                   <font color="red">{{$errors->first("frie_url")}}</font>
		</div>
	</div>
  <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">网站图片</label>
		<div class="col-sm-8">
			<input type="file" class="form-control" name="frie_logo" id="firstname" 
				   >
                  
		</div>
	</div>
  <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">网站联系人</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="frie_names" id="firstname" 
				   placeholder="请输入网站联系人">
                   <font color="red">{{$errors->first("frie_names")}}</font>
		</div>
	</div>
  <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">网站描述</label>
		<div class="col-sm-8">
			<textarea type="text" class="form-control" name="frie_desc" id="lastname" 
				   placeholder="请输入网址描述"></textarea>
                   <font color="red">{{$errors->first("frie_desc")}}</font>
		</div>
	</div>
  <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-8">
		<input type="radio" class="form-control" name="is_new_show" value="1">是
        <input type="radio" class="form-control" name="is_new_show" value="2">否
		</div>
	</div>
  <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">文件类型</label>
		<div class="col-sm-8">
		<input type="radio" class="form-control" name="is_show" value="logo">logo
        <input type="radio" class="form-control" name="is_show" value="文享">文享
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">提交<tton>
		</div>
	</div>
</form>

</body>
<ml>
