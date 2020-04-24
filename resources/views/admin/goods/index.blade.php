<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 一个简单的网页</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<meta name="csrf-token" content="{{csrf_token()}}">
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">微商城</a>
    </div>
   
  </div>
</nav>

<center><h2>品牌管理 <a style="float:right;" href="{{url('/goods/create')}}" class="btn btn-success">添加</a></hr></h2></center>
<form action="">
<input type="text"name="goods_name"placeholder="按照品牌名称搜索"value="{{$goods_name}}">
<button>搜索</button>
</form>
<table class="table table-striped">
	<caption></caption>
	<thead>
		<tr>
        <th>id</th>
        <th>商品名称</th>
        <th>商品图片</th>
        <th>商品相册</th>
        <th>商品详情</th>
        <th>商品分类</th>
        <th>品牌分类</th>
        <th>是否新品</th>
        <th>是否精品</th>
        <th>是否显示</th>
        <th>商品价格</th>
        <th>商品库存</th>
        <th>商品货号</th>
        <th>商品积分</th>
        <th>操作</th>
        </tr>
	</thead>
	<tbody>
    @foreach($goods as $v)
    <tr>
        <td>{{$v->goods_id}}</td>
        <td>{{$v->goods_name}}</td>
        <td><img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" width="20"></td>
        <td>
        @if($v->goods_imgs)
        @php $goods_imgs=explode("|",$v->goods_imgs);@endphp
        @foreach($goods_imgs as $vv)
       <img src="{{env('UPLOADS_URL')}}{{$vv}}" width="20">
        @endforeach
        @endif
        </td>
        <td>{{$v->goods_desc}}</td>
        <td>{{$v->brand_name}}</td>
        <td>{{$v->cart_name}}</td>
        <td>{{$v->is_new=="1"?"√":"×"}}</td>
        <td>{{$v->is_best=="1"?"√":"×"}}</td>
        <td>{{$v->is_new_show=="1"?"√":"×"}}</td>
        <td>{{$v->goods_price}}</td>
        <td>{{$v->goods_num}}</td>
        <td>{{$v->goods_hao}}</td>
        <td>{{$v->goods_score}}</td>
        <td><a  href="{{url('/goods/show/'.$v->goods_id)}}">删除</a>
        <a href="{{url('/goods/show/'.$v->goods_id)}}">修改</a>
        </td>
    </tr>
    @endforeach
		<tr>
			<td colspan="6" align="center">{{ $goods->appends(['goods_name' => $goods_name])->links() }}</td>
		</tr>
			</tbody>
</table>
<script src="/static/jquery.js"></script>
<script>
$(document).on("click",".page-item a",function(){
    var url=$(this).attr("href");
    // $.get(url,function(res){
    //    $("body").html(res);
    // });
    $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr("content")}})
   $.post(url,function(res){
       $("body").html(res);
   })
    return false;
})
</script>

</body>
</html>