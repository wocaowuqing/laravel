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
	<title>比赛</title>
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/Match.css">
</head>
<body>
	<div class="content">
		<header class="header">
			<a href="#"></a>
			<span>比赛</span>
		</header>
		<section class="Match_section" id="wrapper">
			<div id="scroller">
				<div id="pullDown">
					<span class="pullDownIcon"></span><span class="pullDownLabel">下拉刷新...</span>
				</div>
				
				<div class="news-lists" id="news-lists">
				@foreach($newInfo as $k=>$v)
					@if(time()>=$k)
					<div class="Match_used">
						<div class="Match_time">
							<h1>07<span>/3</span><i>{{date("Y-m-d H:i:s",$k)}}</i></h1>
							@foreach($v as $kk=>$vv)
							<div class="Match_table">
			                    <table>
			                        <tbody>
									
			                            <tr>
			                                <td>{{$vv['tA_name']}}<br/>{{$vv['tB_name']}}</td>
			                                <td><em>{{$vv['team_one_min']}}<br/>{{$vv['team_two_min']}}</em></td>
			                                <td>已结束</td>
			                                <td><p>技术统计<i></i></p></td>
			                            </tr>
									
			                        </tbody>
			                    </table>
			                </div>
							@endforeach	
						</div>
						<div class="Match_time">
							<h1>07<span>/3</span><i>星期一</i></h1>
							<div class="Match_table">
			                    <table>
			                        <tbody>
			                            <tr>
			                                <td>深圳航空<br/>深圳航空</td>
			                                <td><em>60%<br/>40%</em></td>
			                                <td>进行中</td>
			                                <td><p style='background:red'>前往直播<i></i></p></td>
			                            </tr>
			                        </tbody>
			                    </table>
			                </div>
						</div>
					</div>
					@else
					<div class="Match_new">
						<div class="Match_box">
							<h1>07<span>/3</span><i>{{date("Y-m-d H:i:s",$k)}}</i></h1>
							@foreach($v as $k2=>$v2)
							<div class="table">
			                    <table>
			                        <tbody>
			                            <tr>
			                                <td>14:00</td>
			                                <td>{{$v2['tA_name']}}   VS   {{$v2['tB_name']}}</td>
			                                <td><em>未开始</em></td>
			                            </tr>
			                        </tbody>
			                    </table>
			                </div>
							@endforeach
						</div>
					</div>
					@endif
				@endforeach
				</div>
					
				<div id="pullUp">
					<span class="pullUpIcon"></span><span class="pullUpLabel">上拉加载更多...</span>
				</div>
		</section>	
		<div id="dv1"><img src="images/up.png"></div>
	</div>
	
</body>
<script src="js/iscroll.js"></script>
<script type="text/javascript" src="js/zepto.min.js"></script>
<script type="text/javascript" src="js/fx.js"></script>
<script type="text/javascript" src="js/touch.js"></script>
<script type="text/javascript" src="js/refresh.js"></script>
<script type="text/javascript">
    document.documentElement.style.fontSize=document.documentElement.clientWidth/24+'px';
   	window.onscroll=function(){
	    if($(window).scrollTop()>100){
	         $('#dv1').show();
	    }else{
	         $('#dv1').hide();
	    }
	} 
	$('#dv1').on("tap",function(){
	    scroll('0px', 300);

	});
	function scroll(scrollTo, time) {
	    var scrollFrom = parseInt(document.body.scrollTop),
	        i = 0,
	        runEvery = 5; // run every 5ms

	    scrollTo = parseInt(scrollTo);
	    time /= runEvery;

	    var interval = setInterval(function () {
	        i++;

	        document.body.scrollTop = (scrollTo - scrollFrom) / time * i + scrollFrom;

	        if (i >= time) {
	            clearInterval(interval);
	        }
	    }, runEvery);
	}
</script>
</html>