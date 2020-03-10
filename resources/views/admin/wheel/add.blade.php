
@extends('layouts.admin')

@section('title', '图片添加')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <title>Document</title>
  <script src="https://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>  
</head>
<body>
<link rel="stylesheet" href="/hadmin/imgaa/index.css">
<a href="index" class="btn btn-primary btn-lg active" role="button">展示轮播图</a>
<form action="{{url('wheel/create')}}" method="post" enctype="multipart/form-data" >
   
      <div class="form-group">
				<label for="exampleInputEmail1">图片名称</label>
				<input type="text" class="form-control" name='wheel_name'>
			</div>
    <div class="upload imgLog2" >
      <span><i class="glyphicon glyphicon-open"></i>上传图片</span>
    </div>
    <div class="form-group">
				<label for="exampleInputEmail1">是否展示</label>
				<input type="radio" name="is_show" value="1" checked>是
        <input type="radio" name="is_show" value="2">否
			</div>
    <input type="submit" value="添加" class="btn btn-info">
</form>
<script src="/hadmin/imgaa/index.js"></script>
  <script>
    $(function(){
      var img2 = new ImgUpload('.imgLog2',100,100,100);
            $(document).on('change',".imgLog2 input",function(e){
          //模拟后台返回url
        $("[type='file']").attr("name",'wheel_img');
          var url = window.URL.createObjectURL(e.target.files[0]);
          $(this).parent().css('background','url('+url+')0% 0% / cover')
          img2.setSpan(this)
      })  
    })

  </script>
</body>
</html>
@endsection