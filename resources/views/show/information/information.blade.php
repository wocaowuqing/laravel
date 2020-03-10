<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<!-- 让IE以最高的文档模式展现效果 -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<!-- 宽度为设备宽度，初始缩放比例为一，用户最大最小缩放比例为一，不允许用户手动缩放 -->
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
	<!-- 禁止ios设备将数字作为拨号连接，邮箱自动发送，点击地图跳转 -->
    <meta name="foemat-detection" content="telephone=no,email=no,adress=no">
    <!-- 强制全屏显示 -->
    <meta name="full-screen" content="yes">
    <!-- 开启对webapp的支持 -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <!-- web app 应用下状态条（屏幕顶部条）的颜色，默认值为default（白色） -->
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <!-- 禁止浏览器从的缓存中访问页面内容 -->
    <meta http-equiv="Pragma" content="no-cache">
    <!-- 禁止winphone系统a、input标签被点击时产生的半透明灰色背景 -->
    <meta name="msapplication-tap-highlight" content="no">
	<title>排名信息</title>
	<link rel="stylesheet" href="/show/css/reset.css">
	<link rel="stylesheet" href="/show/css/information.css">
</head>
<body>
	<div class="content">
		<header class="header">
			<a href="index"></a>
			<span>排名信息</span>
		</header>
		<nav class="nav">
			<ul id="bill">
				<li class="bill_bg">个人排名</li>
				<li>球队排名</li>
			</ul>
		</nav>
<section class="product_section" id="product_section">
	<article class="product_left">
		<div class="count_table">
		
			<div class="count_left">
				<h1><span>排名</span><span>球员姓名</span></h1>
				<ul>
				@foreach($data as $k=>$v)
					<li><span>{{$k+1}}</span><span><img src="/show/images/Guess_header.png">{{$v->player_name}}</span></li>	
				@endforeach
				</ul>
			</div>
			
			<div class="count_right">
				<h1 id="sort"><span id="">所属球队</span><span id="score">得分</span><span id="backboard">篮板</span><span id="assists">助攻</span></h1>
				<ul>
				@foreach($data as $k=>$v)
					<li><span>{{$v->team_name}}</span><span>{{$v->score}}</span><span>{{$v->bank_num}}</span><span>{{$v->help_num}}</span></li>
				@endforeach
								
				</ul>
			</div>
		</div>
	</article>

	<article class="product_right">
		<ul>
		@foreach($new_arr as $k=>$v)
			<li><span><img src="/show/images/ball.png">{{$v}}</span><span><a href="{{url('show/ranking')}}?team_group={{$v}}">查看更多&nbsp;&nbsp;></a></span></li>
			@endforeach
			
		</ul>
	</article>
</section>
</div>
</body>
<script type="text/javascript" src="/show/js/zepto.min.js"></script>
<script type="text/javascript" src="/show/js/fx.js"></script>
<script type="text/javascript" src="/show/js/touch.js"></script>
<script src="http://www.jq22.com/jquery/jquery-1.10.2.js"></script>
<script type="text/javascript">
 	//导航栏切换
 	$(function(){
        window.onload = function()
        {
            var $li = $('#bill li');
            var $ul = $('#product_section  article');
                        
            $li.tap(function(){
                var $this = $(this);
                var $t = $this.index();
                $li.removeClass();
                $this.addClass('bill_bg');
                $ul.css('display','none');
                $ul.eq($t).css('display','block');
            })
        }
    });
	document.documentElement.style.fontSize=document.documentElement.clientWidth/24+'px';
	var container = $('.count_right'),
    scrollTo = $('#row_8');
	container.scrollLeft(scrollTo.offset().left);
	console.log(scrollTo.offset().left);
	container.animate({
	    scrollLeft: scrollTo.offset().left - container.offset().left + container.scrollLeft()
	})
		
	</script>
</html>