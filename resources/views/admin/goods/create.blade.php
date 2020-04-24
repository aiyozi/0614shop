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

<center><h2>商品添加<a href="{{url('/goods')}}" style="float:right" class="btn btn-default">列表</a></h2></center><br>
<form action="{{url('goods/store')}}" method="post" class="form-horizontal" role="form"enctype="multipart/form-data" >
@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品名称</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="goods_name" id="firstname" 
				   placeholder="请输入商品名称">
                   <font color="red">{{$errors->first("goods_name")}}</font>
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品图片</label>
		<div class="col-sm-8">
			<input type="file" class="form-control" name="goods_img" id="firstname" 
				   placeholder="请输入商品图片">
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品相册</label>
		<div class="col-sm-8">
			<input type="file" class="form-control" name="goods_imgs[]" 
				   multiple="multiple">
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品价格</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="goods_price" id="firstname" 
				   placeholder="请输入商品价格">
                   <font color="red">{{$errors->first("goods_price")}}</font>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品积分</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="goods_score" id="firstname" 
				   placeholder="请输入商品积分">
                   <font color="red">{{$errors->first("goods_score")}}</font>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品库存</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="goods_num" id="firstname" 
				   placeholder="请输入商品库存">
                   <font color="red">{{$errors->first("goods_num")}}</font>
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
		<label for="lastname" class="col-sm-2 control-label">是否首页幻灯片展现</label>
		<div class="col-sm-8">
		<input type="radio" class="form-control" name="is_slide" value="1">是
        <input type="radio" class="form-control" name="is_slide" value="2">否
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否新品</label>
		<div class="col-sm-8">
		<input type="radio" class="form-control" name="is_new" value="1">是
        <input type="radio" class="form-control" name="is_new" value="2">否
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否精品</label>
		<div class="col-sm-8">
		<input type="radio" class="form-control" name="is_best" value="1">是
        <input type="radio" class="form-control" name="is_best" value="2">否
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品描述</label>
		<div class="col-sm-8">
			<textarea type="text" class="form-control" name="goods_desc" id="lastname" 
				   placeholder="请输入商品描述"></textarea>
                   <font color="red">{{$errors->first("goods_desc")}}</font>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品货号</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="goods_hao" id="firstname" 
				   placeholder="请输入商品货号">
                   <font color="red">{{$errors->first("goods_hao")}}</font>
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类</label>
		<div class="col-sm-8">
			<select name="cart_id" id="">
            <option value="">--请选择--</option>
            @foreach($cate as $v)
            <option value="{{$v->cart_id}}">{{$v->cart_name}}</option>
            @endforeach
            </select>
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">品牌分类</label>
		<div class="col-sm-8">
			<select name="brand_id" id="">
            <option value="">--请选择--</option>
            @foreach($brand as $v)
            <option value="{{$v->brand_id}}">{{$v->brand_name}}</option>
            @endforeach
            </select>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">购买<tton>
		</div>
	</div>
</form>

</body>
<ml>
