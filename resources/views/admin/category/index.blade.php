<div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
       
        <li><a href="{{url('/category/create')}}">分类管理</a><>
       
      </ul>
    </div>
  </div>
<table border=1>
    <tr>
        <td>id</td>
        <td>分类名称</td>
        <td>分类描述</td>
        <td>是否显示</td>
        <td>是否添加到导航栏</td>
        
        <td>操作</td>
    </tr>
    @foreach($cate as $v)
    <tr>
        <td>{{$v->cart_id}}</td>
        <td align="left">{{str_repeat("--",$v->level)}}{{$v->cart_name}}</td>
        <td>{{$v->cart_desc}}</td>
        <td>{{$v->cart_show=="1"?"√":"×"}}</td>
        <td>{{$v->cart_nav_show=="1"?"√":"×"}}</td>
       
        <td><a href="{{url('/category/edit/'.$v->cart_id)}}">删除</a>
        <a href="{{url('/category/show/'.$v->cart_id)}}">修改</a>
        </td>
    </tr>
    @endforeach
</table>
