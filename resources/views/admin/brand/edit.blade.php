<nav class="navbar bg-light">
 
  <!-- Links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="{{url('/cart/create')}}">品牌分类</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Link 2</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Link 3</a>
    </li>
  </ul>
 
</nav>
<form action="{{url('/brand/update/'.$res->brand_id)}}"method="post"enctype="multipart/form-data">
@csrf
<h4><font color='red'><a href="{{url('/brand')}}">展示</a></font></h4>
    <table>
    <input type="hidden"name="brand_id"value="{{$res->brand_id}}">
        <tr>
            <td>品牌名称</td>
            <td><input type="text"name="brand_name"value="{{$res->brand_name}}"></td>
        </tr>
        <tr>
            <td>品牌Logo</td>
            <td><input type="file"name="logo">
            <img src="{{env('UPLOADS_URL')}}{{$res->logo}}"width="20" alt="">
            </td>
        </tr>
        <tr>
            <td>品牌介绍</td>
            <td><textarea name="brand_desc" id="" cols="30" rows="10">{{$res->brand_desc}}</textarea></td>
        </tr>
        <tr>
            <td>品牌网址</td>
            <td><input type="text"name="brand_url"value="{{$res->brand_url}}"></td>
        </tr>
        <tr>
        <td><input type="submit"value="修改"></td>
        </tr>
    </table>
</form>