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
					<!-- $weekarray = array("星期日","星期一","星期二","星期三","星期四","星期五","星期六"); -->
					<div class="Match_used">
						<?php foreach ($newInfo as $key=>$value): ?>
						<div class="Match_time">
							<h1>{{date("d",strtotime($key))}}<span>/{{date("n",strtotime($key))}}</span><i>星期{{date("w",strtotime($key))}}</i></h1>
							<div class="Match_table">
			                    <table>
			                        <tbody>
									<?php foreach ($value as $key=>$v): ?>
										@if($v['matchStatus'] == 1)
			                            <tr>
											<td>{{$v['tA_name']}}<br/>{{$v['tB_name']}}</td>
			                                <td><em>{{$v['team_one_min']}}<br/>{{$v['team_two_min']}}</em></td>
			                                <td>{{date("H:i",$v['start_time'])}}</td>
			                                <td><p style="background:#ccc">未开始<i></i></p></td>
			                            </tr>
										@elseif($v['matchStatus'] == 2)
										<tr>
											<td>{{$v['tA_name']}}<br/>{{$v['tB_name']}}</td>
			                                <td><em>{{$v['team_one_min']}}<br/>{{$v['team_two_min']}}</em></td>
			                                <td>进行中</td>
			                                <td><p style="background:red">前往直播<i></i></p></td>
			                            </tr>
										@else
										<tr>
											<td>{{$v['tA_name']}}<br/>{{$v['tB_name']}}</td>
			                                <td><em>{{$v['team_one_min']}}<br/>{{$v['team_two_min']}}</em></td>
			                                <td>已结束</td>
			                                <td><p style="background:blue">技术统计<i></i></p></td>
			                            </tr>
										@endif
										
										<?php endforeach ?>
			                        </tbody>
			                    </table>
			                </div>	
						</div>
						<?php endforeach ?>
				

				<div class="Match_new">
					<div class="Match_box">
						<?php foreach ($nextData as $key=>$value): ?>
						<div class="Match_box">
							<h1>{{date("d",strtotime($key))}}<span>/{{date("n",strtotime($key))}}</span><i>星期{{date("w",strtotime($key))}}</i></h1>
								<div class="table">
				                    <table>
				                        <tbody>
											<?php foreach($value as $k=>$v): ?>
				                            <tr>
				                                <td>{{date("H:i",$v['start_time'])}}</td>
				                                <td>{{$v['tA_name']}}   VS   {{$v['tB_name']}}</td>
				                                <td><em>未开始</em></td>
				                            </tr>
				                            <?php endforeach ?>
				                        </tbody>
									</table>
								</div>			
							</div>
							<?php endforeach ?>			
		
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