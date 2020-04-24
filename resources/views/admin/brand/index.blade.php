<!-- 垂直导航栏 -->
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
        <li><a href="{{url('/guan/create')}}">管理员</a><>
      </ul>
    </div>
  </div>
</nav>
<center>
<h4><font color='red'><a href="{{url('/brand/create')}}">添加</a></font></h4>
<form action="">
<input type="text"name="brand_name"placeholder="按照品牌名称搜索"value="{{$brand_name}}">
<button>搜索</button>
</form>
<table border="1">
    <tr>
        <td>品牌ID</td>
        <td>品牌名称</td>
        <td>品牌logo</td>
        <td>品牌网址</td>
        <td>品牌介绍</td>
        <td>操作</td>
    </tr>
    @foreach($res as $v)
    <tr>
        <td>{{$v->brand_id}}</td>
        <td>{{$v->brand_name}}</td>
        <td><img src="{{env('UPLOADS_URL')}}{{$v->logo}}"width="20"></td>
        <td>{{$v->brand_url}}</td>
        <td>{{$v->brand_desc}}</td>
        <td><a href="{{url('/brand/show/'.$v->brand_id)}}">删除</a>
        <a href="{{url('/brand/edit/'.$v->brand_id)}}">修改</a></td>
    </tr>
    @endforeach
    {{ $res->appends(['brand_name' => $brand_name])->links() }}

</table>
</center>
