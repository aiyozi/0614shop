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

<center><h2>友情连接 <a style="float:right;" href="{{url('/friendship/create')}}" class="btn btn-success">添加</a></hr></h2></center>
<form action="">
<input type="text"name="frie_name"placeholder="按照品牌名称搜索"value="{{$frie_name}}">
<button>搜索</button>
</form>
<table class="table table-striped">
	<caption></caption>
	<thead>
		<tr>
        <th>id</th>
        <th>网址名称</th>
        <th>网址图片</th>
        <th>网址介绍</th>
        <th>网站网址</th>
        <th>网址类型</th>
        <th>是否显示</th>
        <th>操作</th>
        </tr>
	</thead>
	<tbody>
    @foreach($res as $v)
    <tr>
        <td>{{$v->frie_id}}</td>
        <td>{{$v->frie_name}}</td>
        <td><img src="{{env('UPLOADS_URL')}}{{$v->frie_logo}}" width="20"></td>
        <td>{{$v->frie_desc}}</td>
        <td>{{$v->frie_url}}</td>
        <td>{{$v->is_show}}</td>
        <td>{{$v->is_new_show=="1"?"√":"×"}}</td>
        <td>
        <a href="{{url('/friendship/edit/'.$v->frie_id)}}" id="aa">删除
        <a href="{{url('/friendship/show/'.$v->frie_id)}}">修改</a>
        </td>
    </tr>
    @endforeach
		<tr>
			<td colspan="6" align="center">{{ $res->appends(['frie_name' =>$frie_name ])->links() }}</td>
		</tr>
			</tbody>
</table>
<script src="/static/jquery.js"></script>
<script>
$(document).on("click","#aa",function(){
    var _this=$(this);
    var url=_this.attr("href");
    $.get(url,function(res){
        _this.remove();
    })
      
    
})
</script>

</body>
</html>