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
<!-- @if ($errors->any()) <div class="alert alert-danger"> <ul> @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul> </div> @endif -->
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
<form action="{{url('/brand/store')}}"method="post" enctype="multipart/form-data">
@csrf
<h4><font color='red'><a href="{{url('/brand')}}">展示</a></font></h4>
    <table>
        <tr>
            <td>品牌名称</td>
            <td><input type="text"name="brand_name">
            <font color="red">{{$errors->first("brand_name")}}</font>
            </td>
        </tr>
        <tr>
            <td>品牌Logo</td>
            <td><input type="file"name="logo"></td>
        </tr>
        <tr>
            <td>品牌介绍</td>
            <td><textarea name="brand_desc" id="" cols="30" rows="10">
            {{$errors->first("brand_desc")}}
            </textarea></td>
        </tr>
        <tr>
            <td>品牌网址</td>
            <td><input type="text"name="brand_url">
            {{$errors->first("brand_url")}}</td>
        </tr>
        <tr>
        <td><input type="submit"value="提交"></td>
        </tr>
    </table>
</form>