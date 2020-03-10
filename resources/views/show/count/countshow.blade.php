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
	<title>技术统计</title>
	<link rel="stylesheet" href="/show/css/reset.css">
	<link rel="stylesheet" href="/show/css/count.css">
</head>
<body>
	<div class="content">
		<header class="header">
			<a href="/show/match"></a>
			<span>技术统计</span>
		</header>
		<section class="count_section">
			<div class="count_box">
				<h2><span>{{$data['team_one_min']}}</span>:<span>{{$data['team_two_min']}}</span></h2>
				<p><span>{{$data['tA_name']}}</span><span>{{$data['tB_name']}}</span></p>
			</div>
			<div class="count_team">
				<h2>———<i>{{$data['tA_name']}}</i>———</h2>
				<div class="count_table">
					<div class="count_left">
						<h1>球员姓名</h1>
						<ul>
							@foreach($playerAData as $k=>$v)
							<li>{{$v['player_name']}}</li>
							@endforeach
						</ul>
						<h3>总计</h3>
					</div>
					<div class="count_right">
						<h1><span>得分</span><span>助攻</span><span>篮板</span></h1>
						<ul>
						@foreach($playerAData as $k=>$v)
							<li>
								<span>{{$v['score']}}</span>
								<span>{{$v['help_num']}}</span>
								<span>{{$v['bank_num']}}</span>
							</li>
						@endforeach
						</ul>
						<h3>
							<span>{{$data['countA_score']}}</span>
							<span>{{$data['countA_help_num']}}</span>
							<span>{{$data['countA_bank_num']}}</span>
						</h3>
					</div>
				</div>
			</div>
			<div class="count_team">
				<h2>———<i>{{$data['tB_name']}}</i>———</h2>
				<div class="count_table">
					<div class="count_left">
						<h1>球员姓名</h1>
						<ul>
							@foreach($playerBData as $k=>$v)
							<li>{{$v['player_name']}}</li>
							@endforeach
						</ul>
						<h3>总计</h3>
					</div>
					<div class="count_right">
						<h1><span>得分</span><span>助攻</span><span>篮板</span></h1>
						<ul>
						@foreach($playerBData as $k=>$v)
							<li>
								<span>{{$v['score']}}</span>
								<span>{{$v['help_num']}}</span>
								<span>{{$v['bank_num']}}</span>
							</li>
						@endforeach
						</ul>
						<h3>
							<span>{{$data['countB_score']}}</span>
							<span>{{$data['countB_help_num']}}</span>
							<span>{{$data['countB_bank_num']}}</span>
						</h3>
					</div>
				</div>
			</div>
		</section>
	</div>
</body>
<script type="text/javascript" src="/show/js/zepto.min.js"></script>
<script type="text/javascript" src="/show/js/fx.js"></script>
<script type="text/javascript" src="/show/js/touch.js"></script>
<script type="text/javascript">
	document.documentElement.style.fontSize=document.documentElement.clientWidth/24+'px';
	
</script>
</html>