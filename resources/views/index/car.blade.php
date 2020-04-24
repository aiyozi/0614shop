     @extends("layouts.shop")
     @section("title",'购物车列表')
     @section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>购物车</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <table class="shoucangtab">
      <tr>
       <td width="75%"><span class="hui">购物车共有：<strong class="orange">{{$com}}</strong>件商品</span></td>
       <td width="25%" align="center" style="background:#fff url(/static/index/images/xian.jpg) left center no-repeat;">
        <span class="glyphicon glyphicon-shopping-cart" style="font-size:2rem;color:#666;"></span>
       </td>
      </tr>
     </table>
     <tr>
        <td width="100%" colspan="4"><a href="javascript:;"><input type="checkbox" name="1" id="allBox"/> 全选</a></td>
     </tr>
     @foreach($cart as $k=>$v)
     <div class="dingdanlist">
      <table>
       <tr goods_id="{{$v->goods_id}}">
        <td width="4%"><input type="checkbox" value="{{$v->cart_id}}" name="1" class="box" /></td>
        <td class="dingimg" width="15%"><img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" /></td>
        <td width="50%">
         <h3>{{$v->goods_name}}</h3>
         <time>下单时间：{{date("Y-m-d H:i:s",$v->addtime)}}</time>
        </td>
        <th id="price" colspan="4"><strong class="orange"id="orange">{{$v->goods_price}}</strong></th>
        <td id="xj" colspan="4"><strong class="orange">{{$v->goods_price*$v->buy_num}}</strong></td>
        <td align="right"><input type="text" id="buy_{{$v->cart_id}}" class="spinnerExample" /></td>
        <td><h3 id="dele">删除</h3></td>
       </tr>
      
      </table>
     </div><!--dingdanlist/-->
     @endforeach
   
     <div class="height1"></div>
     总计：<strong class="orange" id="zorange"></strong>
     <td width="40%"><a href="javascript:;" id="submit" class="jiesuan">去结算</a></td>
    
     
    
      </tr>
     </table>
    </div><!--gwcpiao/-->
    </div><!--maincont-->
     <script>

    //  加号
    $(document).on("click",".increase",function(){
      var _this=$(this);
      var buy_num=_this.prev().val();
      var goods_id=_this.parents("tr").attr("goods_id");
      getnum(buy_num,goods_id);
      fx(_this);
      many();
    })
  //  减号
   $(document).on("click",".decrease",function(){
      var _this=$(this);
      var buy_num=_this.next().val();
      var goods_id=_this.parents("tr").attr("goods_id");
      // alert(goods_id);
      getnum(buy_num,goods_id);
      fx(_this);
      many()
    })
     // 总价
     
     function many(){
      var box=$(".box:checked");
      // console.log(box);
      if(box.length==0){
        $("#zorange").html(0);
        return false;
      }
      many=0;
      box.each(function(index){
        var _this=$(this);
         // 获取小计
         var xj=_this.parents("tr").find("#xj").text();
        // console.log(xj);
        // 小计相加  转化位数字类型
        xj=xj.trim();
        many+=Number(xj);
        
      })
      $("#zorange").text(many);
    }
    function getnum(buy_num,goods_id){
      $.get('/carget',{buy_num:buy_num,goods_id,goods_id},function(res){
      if(res.code=="0"){
        alert(res.msg);
      }else{
        alert(res.msg);
      }
      },'json');
    }
   
    // 复选框
    function fx(_this){
      _this.parents("tr").find(".box").prop("checked",true);
    }
    $("#allBox").click(function(){
      // alert("1");
      var _this=$(this);
      var state=_this.prop("checked");
      // 给全选
      $(".box").prop("checked",state);
     many();
    })
// 删除
$(document).on("click","#dele",function(){
      var _this=$(this);
      var goods_id=$(this).parents("tr").attr("goods_id");
      // alert(goods_id);
      $.get("/cardele",{goods_id:goods_id},function(res){
        if(res.code=="0"){
          alert(res.msg);
        }else{
          alert(res.msg);
        }
      },'json')
})
    // 确认结算
$(document).on("click","#submit",function(){
      var _this=$(this);
     var box=$(".box:checked");
    //  console.log(box);
    if(box.length==0){
        alert("你至少的给女票买一件吧");
        return false;
      }
      var str='';
      box.each(function(index){
       str+= $(this).parents("tr").attr("goods_id")+",";
      })
      // 去掉逗号
      str=str.trim();
      
      str= str.substr(0,str.length-1);
      // console.log(str);
      location.href="{{url('pay')}}/"+str;
})
     </script>
@endsection