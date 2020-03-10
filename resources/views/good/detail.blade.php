<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Sinwa图片直播 - 详情</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta content="yes" name="apple-mobile-web-app-capable" />
	<meta content="black" name="apple-mobile-web-app-status-bar-style" />
	<meta content="telephone=no" name="format-detection" />
	<meta content="email=no" name="format-detection" />
	<link rel="stylesheet" type="text/css" href="/assert/css/reset.css" />
	<link rel="stylesheet" type="text/css" href="/assert/css/main.css" />
	<link rel="stylesheet" href="/assert/iconfont/iconfont.css">
	<link rel="shortcut icon" href="/favicon.ico">
	<script src="/js/jquery-3.2.1.min.js"></script>
	<style>
		/*详情界面保持上部分静止，下面滚动; 同样利用flex布局 poster自然高度， tab-nav自然高度， tab-block填满剩余部分*/
		.poster {
			position: relative;
		}
		.post-img {
			height: 30vh;
			width: 100%;
		}
		.poster-title {
			position: absolute;
			bottom: 0;
			display: flex;
			align-items: center;
			color: #fff;
			width: 100%;
			height: 80px;
			/*这里不要使用opacity属性，文字也会继承透明属性，使用rgpa*/
			background: rgba(0, 0, 0, 0.3);
		}
		.poster-title-team {
			flex: 1;
			text-align: center;
		}
		.poster-title-team img {
			border-radius: 50%;
		}
		/* ************************tab 切换******************************* */
		.tab-nav {
			display: flex;
			margin-top: 5px;
			padding: 5px 0;
			text-align: center;
		}
		.tab-nav > div {
			flex: 1;
			line-height: 2rem;
			font-size: 1.1rem;
			text-align: center;
			border-right: 1px solid #eee;
			padding-bottom: 2px;
		}
		.tab-nav > div:last-child {
			border: none;
		}
		.tab-nav > div.active {
			border-bottom: 2px solid #38f;
		}
		.tab-block {
			flex: 1;
			overflow-y: scroll;
		}

		/******************赛况 frame时间片段的意思*****************/
		.frame {
			padding: 5px;
		}
		/*加强时间icon的效果*/
		.frame .icon {
			font-weight: bold;
			margin-right: 5px;
		}
		.frame-header {
			font-size: 0.8rem;
			display: inline-block;
			padding: 2px 5px;
			background: red;
			color: #fff;
			border-radius: 10px;
		}
		.frame-item {
			position: relative;
			margin-left: 5px;
			border-left: 1px dotted #38f;
			padding: 20px 10px 0;
		}
		.frame-item > p {
			font-size: 1rem;
			color: #404040;
			padding: 5px 0;
		}
		.frame-dot {
			position: absolute;
			width: 6px;
			height: 6px;
			background: #38f;
			border-radius: 50%;
			left: -4px;
    		top: 27px;
		}
		.frame-item-author {
			color: #888;
			font-size: 0.8rem;
			vertical-align: middle;
		}
		/* *************** 评论 ****************  */
		.comments {
			/*为评论输入框留位置，由于输入框是绝对定位*/
			padding-bottom: 50px;
		}
		.comment-form {
			position: fixed;
			bottom: 0;
			left: 0;
			width: 100%;
			height: 50px;
		}
		.comment-form input {
			background:ghostwhite;
			border-top: 1px solid #eee;
			outline: none;
			padding: 5px 10px;
			width: 100%;
			height: 100%;
		}
		.comment {
			font-size: 1rem;
			line-height: 1.5rem;
			margin: 5px 10px;
		}
		.comment > span:first-child {
			color: #38f;
		}


		/*比赛数据*/
		.match-data {
			background: #eee;
		}
		.match-data > div {
			background: #fff;
			margin-bottom: 10px;
			padding: 10px;
		}
		.match-score {
			display: flex;
			flex-direction: row;
			align-items: center;
			text-align: center;
		}
		.match-team-info {
			flex: 1;
		}
		.match-team-info img {
			margin-bottom: 5px;
		}
		.match-score-result {
			flex: 3;
		}
		.match-score-result > div {
			margin: 5px 0;
		}
		.sub-title {
			font-size: 1.1rem;
			font-weight: bold;
		}
		.match-report-row {
			display: flex;
			height: 40px;
			line-height: 40px;
			text-align: center;
			align-items: center;
		}
		.match-report-row.row-title {
			border-bottom: 1px solid #eee;
			color: #888;
			font-size: .8rem;
		}
		.match-report-row span {
			flex: 1;
		}
		.match-report-row span:first-child {
			text-align: left;
		}
		.match-report-row span:last-child {
			text-align: right;
		}

		/* 本场最佳 */
		.mvp > div {
			margin: 10px 0;
			display: flex;
			justify-content: space-between;
			align-items: center;
		}
		.mvp-score {
			display: flex;
			font-size: 1.1rem;
			text-align: center;
			justify-content: space-between;
			align-items: center
		}
		.mvp-score span {
			margin: 0 10px;
		}
		.mvp-score-label {
			font-size: .8rem;
			color: #888;
		}
		.mvp-player {
			flex: 1;
			display: flex;
			align-items: center;
		}
		/*让第二个球员的信息，靠右*/
		.mvp-player:last-child {
			justify-content: flex-end;
		}
		.mvp-player-info {
			margin: 0 5px;
			font-size: .8rem;
			color: #888;
		}
		.mvp-player img {
			border-radius: 50%;
		}
	</style>
</head>

<body>
	<header class="header xxl-font">
		<i class="icon iconfont icon-fanhui back" id="back"></i>
		{{$data['teamAname']}}vs{{$data['teamBname']}}
		<!--用户处于登录状态时，将该按钮隐藏-->
		<a href="/login.html">
			<i class="icon iconfont icon-wode my"></i>
		</a>
	</header>
	<div class="content">
		<div class="poster">
			<img src="/imgs/match-poster.png" class="post-img" />
			<div class="poster-title">
				<div class="poster-title-team">
					<img src="/imgs/team1.png" width="40px" height="40px">
					<div>{{$data['teamAname']}}({{$data['teamAscore']}})</div>
				</div>
				<div>VS</div>
				<div class="poster-title-team">
					<img src="/imgs/team2.png" width="40px" height="40px">
					<div>{{$data['teamBname']}}({{$data['teamBscore']}})</div>
				</div>
			</div>
		</div>
		<div class="tab-nav">
			<div class="active">赛况</div>
			<div>聊天室</div>
			<div>数据</div>
		</div>
		<div class="tab-block">
			<div id="match-result">
				<!-- <div class="frame">
					<h3 class="frame-header">
						<i class="icon iconfont icon-shijian"></i>第一节 01：30
					</h3>
					<div class="frame-item">
						<span class="frame-dot"></span>
						<div class="frame-item-author">
							<img src="/imgs/team1.png" width="20px" height="20px" /> 马刺
						</div>
						<p>08:44 暂停 常规暂停</p>
						<p>08:4   4 帕克 犯规 个人犯规 2次</p>
					</div>
					<div class="frame-item">
						<span class="frame-dot"></span>
						<div class="frame-item-author">
							singwa(评论员)
						</div>
						<p>01:44 </p>
						<p>01:46 犯规 个人犯规 Ruan</p>
					</div>
				</div> -->
			</div>
			<div id="comments" class="hidden comments">

				<!-- <div class="comment">
					<span>xixi</span>
					<span>赞~</span>
				</div> -->

				<div class="comment-form">
					<input type="text" placeholder="别憋着，说点啥~~ 回车既发射" id="chat"></input>
				</div>
			</div>
			<div id="match-data" class="hidden match-data">
				<div class="match-score">
					<div class="match-team-info">
						<img src="/imgs/team1.png" width="40px" height="40px" />
						<div>{{$data['teamAname']}}</div>
					</div>
					<div class="match-score-result">
						<div style="font-size: .8rem;color: red;">第一小节 01：40</div>
						<div style="font-size: 1.2rem; color:red;">
							<span>{{$data['teamAscore']}}</span>
							<span>Live</span>
							<span>{{$data['teamBscore']}}</span>
						</div>
						<div style="font-size: .8rem; color:#888;">NBA常规赛</div>
					</div>
					<div class="match-team-info">
						<img src="/imgs/team2.png" width="40px" height="40px" />
						<div>{{$data['teamBname']}}</div>
					</div>
				</div>
				<div class="match-report">
					<h3 class="sub-title">赛况</h3>
					<div class="match-report-row row-title">
						<span>球队</span>
						<span>1TH</span>
						<span>2TH</span>
						<span>3TH</span>
						<span>4TH</span>
						<span>总分</span>
					</div>
					<div class="match-report-row">
						<span><img src="/imgs/team1.png" width="30px" height="30px" /></span>
						<span>20</span>
						<span>-</span>
						<span>-</span>
						<span>20</span>
						<span>40</span>
					</div>
					<div class="match-report-row">
						<span>
							<img src="/imgs/team2.png" width="30px" height="30px" />
						</span>
						<span>15</span>
						<span>-</span>
						<span>-</span>
						<span>30</span>
						<span>40</span>
					</div>
				</div>
				<div class="mvp">
					<h3 class="sub-title">本场最佳</h3>
					<div>
						<div class="mvp-player">
							<img src="/imgs/pa.png" width="50px;" height="40px" />
							<div class="mvp-player-info">
								<div>9</div>
								<div>帕克</div>
							</div>
						</div>
						<div class="mvp-score">
							<span>10</span>
							<span class="mvp-score-label">得分</span>
							<span>12</span>
						</div>
						<div class="mvp-player">
							<div class="mvp-player-info">
								<div>13</div>
								<div>哈登</div>
							</div>
							<img src="/imgs/ha.png" width="50px;" height="40px" />
						</div>
					</div>
					<div>
						<div class="mvp-player">
							<img src="/imgs/pa.png" width="50px;" height="40px" />
							<div class="mvp-player-info">
								<div>9</div>
								<div>帕克</div>
							</div>
						</div>
						<div class="mvp-score"><span>10</span><span class="mvp-score-label">助攻</span><span>9</span></div>
						<div class="mvp-player">
							<div class="mvp-player-info">
								<div>3</div>
								<div>保罗</div>
							</div>
							<img src="/imgs/bao.png" width="50px;" height="40px" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<script type="text/javascript">
$(function () {
	var match_id =<?php echo $data['id']; ?>;
	var wsServer = 'ws://39.105.74.143:9501';
	var websocket = new WebSocket(wsServer);
	websocket.onopen = function (evt) {
		// console.log("连接上了");
		var json='{"type":"entrance","match_id":"'+match_id+'"}'
		// //发送
		websocket.send(json)
	};

	websocket.onclose = function (evt) {
		console.log("Disconnected");
	};

	websocket.onmessage = function (evt) {
		var data=JSON.parse(evt.data)
		data.time=timestampToTime(data.time)
		if (data.match_id==match_id) {
			//官方推送
			if (data.type=='official') {
				var str='';
				_this='';
				if (data.push_id==1) {
					var node="";
					if (data.node=="1") {
						node="第一节"
					}else if (data.node=="2") {
						node="第二节"
					}else if (data.node=="3") {
						node="第三节"
					}else if (data.node=="4") {
						node="第四节"
					}
    				str='<div class="frame">\
							<h3 class="frame-header">\
								<i class="icon iconfont icon-shijian"></i>'+node+' '+data.time+'\
							</h3>\
						</div>';
					$('#match-result').append(str)
    			}else if(data.push_id==2){
    				if ($('.names').last().text()!=data.msg_name) {
						str='<div class="frame-item">\
							<span class="frame-dot"></span>\
							<div class="frame-item-author">\
								<img src="/imgs/team1.png" width="20px" height="20px" />\
								<span class="names">'+data.msg_name+'</span>\
							</div>\
						</div>'
						$('.frame').last().append(str)
    				}
					if(data.msg!=''){
						var msg='<p>'+data.time+' '+data.msg+'</p>'
						$('.frame-item').last().append(msg)
					}
					
    			}else if(data.push_id==3){
    				if ($('.names').last().text()!=data.msg_name) {
						str='<div class="frame-item">\
							<span class="frame-dot"></span>\
							<div class="frame-item-author">\
								<span class="names">'+data.msg_name+'</span>\
							</div>\
						</div>'
						$('.frame').last().append(str)
    				}
					if(data.msg!=''){
						var msg='<p>'+data.time+' '+data.msg+'</p>'
						$('.frame-item').last().append(msg)
					}
    			}
			}
			if (data.type=='news') {
				$('.comment-form').before('<div class="comment">\
					<span>'+data.phone+':</span>\
					<span>'+data.msg+'</span>\
				</div>')
			}
		}
		
		console.log('服务器发来的信息: ' + evt.data);
	};

	websocket.onerror = function (evt, e) {
		console.log('Error occured: ' + evt.data);
	};

	$.ajax({
	  	method: "get",
	  	url: "/nba/match_msg",
	  	data: { match_id:match_id},
	  	dataType:'json'
	}).done(function( msg ) {
	    if (msg.code==1) {
	    	$.each(msg.data,function(k,v){
	    		v.time=timestampToTime(v.time)
	    		var str='';
				if (v.push_id==1) {
					var node="";
					if (v.node=="1") {
						node="第一节"
					}else if (v.node=="2") {
						node="第二节"
					}else if (v.node=="3") {
						node="第三节"
					}else if (v.node=="4") {
						node="第四节"
					}
    				str='<div class="frame">\
							<h3 class="frame-header">\
								<i class="icon iconfont icon-shijian"></i>'+node+' '+v.time+'\
							</h3>\
						</div>';
					$('#match-result').append(str)
    			}else if(v.push_id==2){
    				if ($('.names').last().text()!=v.msg_name) {
						str='<div class="frame-item">\
							<span class="frame-dot"></span>\
							<div class="frame-item-author">\
								<img src="/imgs/team1.png" width="20px" height="20px" />\
								<span class="names">'+v.msg_name+'</span>\
							</div>\
						</div>'
						$('.frame').last().append(str)
    				}
					if(v.msg!=''){
						var msg='<p>'+v.time+' '+v.msg+'</p>'
						$('.frame-item').last().append(msg)
					}
    			}else if(v.push_id==3){
    				if ($('.names').last().text()!=v.msg_name) {
						str='<div class="frame-item">\
							<span class="frame-dot"></span>\
							<div class="frame-item-author">\
								<span class="names">'+v.msg_name+'</span>\
							</div>\
						</div>'
						$('.frame').last().append(str)
    				}
					if(v.msg!=''){
						var msg='<p>'+v.time+' '+v.msg+'</p>'
						$('.frame-item').last().append(msg)
					}
    			}
	    	})
	    		
	    }
	});
	$.ajax({
	  	method: "get",
	  	url: "/nba/user_msg",
	  	data: { match_id:match_id},
	  	dataType:'json'
	}).done(function( msg ) {
		if (msg.code==1) {
			$.each(msg.data,function(k,v){
				$('.comment-form').before('<div class="comment">\
					<span>'+v.phone+':</span>\
					<span>'+v.msg+'</span>\
				</div>')
			})
		}
	})
	$('#chat').keydown(function (event) {
		var user=JSON.parse(getCookie('user')) 
		if (user=='') {
			location.href="/nba/login"
		}
        if (event.keyCode == 13) {
          	var text=$(this).val();
			var json='{"type":"news","match_id":"'+match_id+'","phone":"'+user.phone+'","msg":"'+text+'"}'
			websocket.send(json)
			$(this).val('')
			$.ajax({
			  	method: "get",
			  	url: "/nba/create_user_msg",
			  	data: { match_id:match_id,user_id:user.user_id,msg:text},
			  	dataType:'json'
			}).done(function( msg ) {
	    		if (msg.code==1) {
	    			console.log(1)
	    		}
	    	})
        }
    });
})
</script>
<script>
$(function () {
	var $nav = $('.tab-nav div');
	var $content = $('.tab-block > div');
	var $back = $('#back');

	/*切换tab*/
	$nav.click(function () {
		var $this = $(this);
		var $t = $this.index();
		$nav.removeClass();
		$this.addClass('active');
		$content.css('display', 'none');
		$content.eq($t).css('display', 'block');
	});

	$back.click(function () {
		window.history.back();
	});

});
function timestampToTime(timestamp) {

    var date = new Date(timestamp * 1000);//时间戳为10位需*1000，时间戳为13位的话不需乘1000

//     Y = date.getFullYear() + '-';

//     M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1) + '-';

//     D = date.getDate() + ' ';

    h = date.getHours() + ':';

    m = date.getMinutes() + ':';

    s = date.getSeconds();
// Y+M+D+h+
    return m+s;

}
function setCookie(key, value, iDay) {
	var oDate = new Date();
	oDate.setDate(oDate.getDate() + iDay);
	document.cookie = key + '=' + value + ';expires=' + oDate;

}
function removeCookie(key) {
	setCookie(key, '', -1);//这里只需要把Cookie保质期退回一天便可以删除
}
function getCookie(key) {
	var cookieArr = document.cookie.split('; ');
	for(var i = 0; i < cookieArr.length; i++) {
		var arr = cookieArr[i].split('=');
		if(arr[0] === key) {
			return arr[1];
		}
	}
	return false;
}
</script>
</body>
</html>