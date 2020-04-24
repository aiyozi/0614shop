<h4><font color='red'><a href="{{url('/admin/create')}}">添加</a></font></h4>
<table border="1">
    <tr>
        <td>id</td>
        <td>用户名城</td>
        <td>用户手机号</td>
        <td>用户邮箱</td>
        <td>时间</td>
        <td>操作</td>
        
    </tr>
    @foreach($res as $v)
    <tr>
        <td>{{$v->user_id}}</td>
        <td>{{$v->user_name}}</td>
        <td>{{$v->user_tel}}</td>
        <td>{{$v->user_email}}</td>
        <td>{{date('Y-m-d H:i:s',$v->time)}}</td>
        <td>
        <a href="{{url('/admin/edit/'.$v->user_id)}}">删除</a>
        <a href="{{url('/admin/show/'.$v->user_id)}}">修改</a>
        </td>
       @endforeach
    </tr>
</table>