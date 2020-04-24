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

<center><h2>分类添加<a href="{{url('/category')}}" style="float:right" class="btn btn-default">列表</a></h2></center><br>
<form action="{{url('category/store')}}" method="post" class="form-horizontal" role="form" >
@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类名称</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="cart_name" id="firstname" 
				   placeholder="请输入分类名称">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">父类ID</label>
		<div class="col-sm-8">
			<select name="prent_id" id="">
            <option value="0">--请选择--</option>
          @foreach($cate as $v)
			<option value="{{$v->prent_id}}">{{str_repeat("--",$v->level)}}{{$v->cart_name}}</option>
		  @endforeach
            </select>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-8">
		<input type="radio" class="form-control" name="cart_show" value="1">是
        <input type="radio" class="form-control" name="cart_show" value="2">否
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否在导航栏显示</label>
		<div class="col-sm-8">
		<input type="radio" class="form-control" name="cart_nav_show" value="1">是
        <input type="radio" class="form-control" name="cart_nav_show" value="2">否
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">分类描述</label>
		<div class="col-sm-8">
			<textarea type="text" class="form-control" name="cart_desc" id="lastname" 
				   placeholder="请输入分类描述"></textarea>
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
