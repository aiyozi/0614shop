@extends("layouts.shop")
     @section("title",'详情')
     @section('content')
  <body>
    <div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>产品详情</h1>
      </div>
     </header>
     <div id="sliderA" class="slider">
     @if($goods->goods_imgs)
        @php $goods_imgs=explode("|",$goods->goods_imgs);@endphp
        @foreach($goods_imgs as $vv)
      <img src="{{env('UPLOADS_URL')}}{{$vv}}" />
      @endforeach
        @endif
     </div><!--sliderA/-->
     <table class="jia-len">
      <tr>
       <th><strong class="orange">{{$goods->goods_price}}</strong>
       
       </th>
       <th><strong class="orange">当前访问量:{{$count}}</strong>
       
       </th>
       <td>
        <input type="text" id="buy_num" class="spinnerExample" />
       </td>
      </tr>
      <tr>
       <td>
        <strong></strong>
        <p class="hui">{{$goods->goods_names}}</p>
       </td>
       <td align="right">
        <a href="javascript:;" class="shoucang"><span class="glyphicon glyphicon-star-empty"></span></a>
       </td>
      </tr>
     </table>
     <div class="height2"></div>
     <h3 class="proTitle">商品规格</h3>
     <ul class="guige">
      <li class="guigeCur"><a href="javascript:;">50ML</a></li>
      <li><a href="javascript:;">100ML</a></li>
      <li><a href="javascript:;">150ML</a></li>
      <li><a href="javascript:;">200ML</a></li>
      <li><a href="javascript:;">300ML</a></li>
      <div class="clearfix"></div>
     </ul><!--guige/-->
     <div class="height2"></div>
     <div class="zhaieq">
      <a href="javascript:;" class="zhaiCur">商品简介</a>
      <a href="javascript:;">商品参数</a>
      <a href="javascript:;" style="background:none;">订购列表</a>
      <div class="clearfix"></div>
     </div><!--zhaieq/-->
     <div class="proinfoList">
      <img src="/static/index/images/image4.jpg" width="636" height="822" />
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息....
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息......
     </div><!--proinfoList/-->
     <table class="jrgwc">
      <tr>
       <th>
        <a href="index.html"><span class="glyphicon glyphicon-home"></span></a>
       </th>
       <td><a href="javascript:;" id="submit">加入购物车</a></td>
      </tr>
     </table>
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
   
  </body>
</html>
<script>
  $(document).on("click","#submit",function(){
    var buy_num=$("#buy_num").val();
    var goods_id={{$goods->goods_id}};
   $.get("/addcar",{buy_num:buy_num,goods_id:goods_id},function(res){
    if(res.code=="1"){
      alert(res.msg);
      location.href="/login?refer="+window.location.href;
    }
    if(res.code=="0"){
      alert(res.msg);
      location.href="/car";
    }
   },'json')
  })
</script>
@endsection