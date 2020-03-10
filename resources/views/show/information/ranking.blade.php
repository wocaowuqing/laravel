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
	<link rel="stylesheet" href="/show/css/ranking.css">
</head>
<body>
	<div class="content">
		<header class="header">
			<a class="a_back" href="information"></a>
			<span>排名信息</span>
		</header>
		<section class="ranking_box">
            <div class="ranking_login">
                <h1>{{$team_group}}</h1>
                <p></p>
            </div>
            <div class="ranking_table">
                <table>
                    <thead>
                         <tr>
                            <td>排名</td>
                            <td>队名</td>
                            <td>胜</td>
                            <td>负</td>
                            <td>积分</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($info as $k=>$v)
                            <tr>
                                <td>{{$k+1}}</td>
                                <td>{{$v['team_name']}}</td>
                                <td><em>{{$v['team_win']}}</em></td>
                                <td><em>{{$v['team_defeat']}}<em></td>
                                <td>{{$v['team_min']}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
		</section>
	</div>
</body>
<script type="text/javascript" src="/show/js/zepto.min.js"></script>
<script type="text/javascript">
    document.documentElement.style.fontSize=document.documentElement.clientWidth/24+'px';
    
</script>
</html>