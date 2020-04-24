<form >
  名称:<input type="text" name="name" value="{{$name}}">
  <button>搜索</button>
</form>
<table>
    <tr>
        <td>id</td>
        <td>名称</td>
        <td>行政</td>
    </tr>
    @foreach($res as $v)
    <tr>
        <td>{{$v->id}}</td>
        <td>{{$v->name}}</td>
        <td>{{$v->test}}</td>
    </tr>
    @endforeach
    {{ $res->appends(['name' => $name])->links() }}
</table>