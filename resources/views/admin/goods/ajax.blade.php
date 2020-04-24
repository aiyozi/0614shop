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