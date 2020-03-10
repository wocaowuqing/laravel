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
	<title>@yield('首页')</title>
	<link rel="stylesheet" href="/index/css/reset.css">
	<link rel="stylesheet" href="/index/css/style.css">
</head>
<body>

<body>
	<div class="content">
		<header class="header">
			<span>乐柠篮球赛直播平台</span>
		</header>
		<section class="activity_box">
			<div class="index-ad-box">
		        <div class="index-ad-slide">
                @foreach($data as $v)
                    
                    <a href="#" ><img src="/{{$v->wheel_img}}" height="310px" width="420px" class="index-ad"></a>
		            <!-- <a href="#" class="index-ad-0" num='4'></a>
		            <a href="#" class="index-ad-1" num='0'>1</a>
		            <a href="#" class="index-ad-2" num='1'>2</a> -->
                @endforeach
		        </div>
		        <div class="index-ad-fixed">
		            <a href="#" class="index-ad-fixed-on"></a>
		            <a href="#"></a>
		            <a href="#"></a>
		        </div>
		    </div>
			<div class="activity_content">
				<dl>
                    <a href="match">
                        <dt><img src="/index/images/03.png"></dt>
                        <dd>比赛</dd>
                    </a>
				</dl>
				<dl>
                    <a href="information">
                        <dt><img src="/index/images/05.png"></dt>
                        <dd>排名</dd>
                    </a>					
				</dl>
				<dl>
                    <a href="">
                        <dt><img src="/index/images/10.png"></dt>
                        <dd>投票</dd>
                    </a>
				</dl>
				<dl>
                    <a href="guess">
                        <dt><img src="/index/images/11.png"></dt>
                        <dd>竞猜</dd>
                    </a>
				</dl>
			</div>
		</section>
	</div>
</body>
<script type="text/javascript" src="/index/js/zepto.min.js"></script>
<script type="text/javascript" src="/index/js/fx.js"></script>
<script type="text/javascript" src="/index/js/touch.js"></script> 
<script type="text/javascript">
    document.documentElement.style.fontSize=document.documentElement.clientWidth/24+'px';

    document.documentElement.style.fontSize=document.documentElement.clientWidth/24+'px';
    (function ($) {
        $.fn.touchMove = function() {
            var windowWidth = $(window).width(),
                windowHeight = $(window).height(),
                size = $(this).children().size(),
                startX ,
                startY,
                XX,
                YY,
                startLeft,
                moveX,
                swipeX,
                swipeY,
                bj,
                bjz,
                translateX;
            windowWidth = windowWidth >= 640 ? 640 : windowWidth;
            $(this).css('width', windowWidth * (size + 1) ).children('a').css('width' ,windowWidth );
            $(this).css('transform', 'translate3d('+-windowWidth+'px,0px,0px)');
            $(this).live('touchstart' ,function(event) {
                var date = new Date();
                 time1 = date.getTime();
                startLeft = parseFloat($(this).css('transform').match(/\-?[0-9]+/g)[1]);
                startX = event.targetTouches[0].pageX;
                startY = event.targetTouches[0].pageY;
                swipeX = true;
                swipeY = true;
            });
            $(this).live('touchmove', function(event) {
                translateX = parseFloat($(this).css('transform').match(/\-?[0-9]+/g)[1]);
                XX = event.targetTouches[0].pageX;
                YY = event.targetTouches[0].pageY;
                if ( swipeX  && Math.abs(XX - startX) - Math.abs(YY - startY) > 0  ) {
                    $(this).bind('touchmove' , function(event) {
                        event.preventDefault();
                    });
                    swipeY = false;
                    moveX = parseFloat($(this).css('transform').match(/\-?[0-9]+/g)[1]) + event.targetTouches[0].pageX - startX;
                    startX = event.targetTouches[0].pageX;
                    $(this).css('transform', 'translate3d('+moveX+'px, 0px,0px)');
                } else if ( swipeY && Math.abs(XX - startX) - Math.abs(YY - startY) < 0 ) {
                    swipeX = false;
                }
            });
            $(this).live('touchend', function(event) {
                var date = new Date();
                var time2 = date.getTime();
                $(this).unbind('touchmove');
                translateX = parseFloat($(this).css('transform').match(/\-?[0-9]+/g)[1]);
                bj = windowWidth + translateX % windowWidth;
                if ( time2 - time1 >= 300 ) {
                    bjz = windowWidth/2;//滑过1/2翻页
                    if ( bj <= bjz ) {
                        left = translateX - bj;
                    } else {//复原
                        left = translateX + (windowWidth - bj);
                    }
                } else {
                    bj = Math.abs(translateX % windowWidth);
                    bjz = windowWidth/4;//滑过1/4翻页(点滑效果)
                    if ( translateX >= startLeft ) {//页面向右滑动
                        if ( bj >= bjz ) {
                            left = translateX + bj;
                        } else {
                            left = translateX -( windowWidth - bj );
                        }
                    } else {//页面向左滑动
                        if ( bj >= bjz * 3 ) {
                            left = translateX + bj;
                        } else {
                            left = translateX -(windowWidth - bj);
                            
                        }
                    }  
                }
                if ( startLeft < left ) {//向右滑动
                    $(this).animate({transform:'translate3d(0px,0px,0px)'},200,"linear",function(){
                    index--;
                    if ( index === -1  ) {
                        index = size - 1;
                    }
                    $(this).next().children('a').eq(index).addClass('index-ad-fixed-on').siblings().removeClass('index-ad-fixed-on');
                    $(this).css({transform : 'translate3d('+windowWidth/(-1)+'px,0px,0px)'});
                    $(this).children('a').last().remove().clone(true).insertBefore($(this).children('a').first());
                    }) ; 
                } else if ( startLeft > left ) {//向左滑动
                    $(this).animate({transform:'translate3d('+windowWidth*(-2)+'px,0px,0px)'},200,"linear",function(){
                    index++;
                    if ( index === size  ) {
                        index = 0;
                    }
                    $(this).next().children('a').eq(index).addClass('index-ad-fixed-on').siblings().removeClass('index-ad-fixed-on');
                    $(this).css({transform:'translate3d('+windowWidth/(-1)+'px,0px,0px)'});
                    $(this).children('a').first().remove().clone(true).appendTo($(this)); 
                    }) ; 
                } else { //复原
                    $(this).css('transition' , 'transform 200ms ease-out');
                    $(this).css('transform', 'translate3d('+left+'px,0px,0px)');
                }
            });
        };
    })($);
    (function($){
        $.autoPlay = function(obj) {
            var windowWidth = $(window).width(),
            left = parseFloat(obj.css('transform').match(/\-?[0-9]+/g)[1]),
            len = obj.children().size(),
            flag = true;
            windowWidth = windowWidth >= 640 ? 640 : windowWidth;
            function showImg() {
               obj.animate({transform:'translate3d('+windowWidth*(-2)+'px,0px,0px)'},300,"linear",function(){
                index++;
                if (index === len) {
                    index = 0;
                }
                obj.next().children('a').eq(index).addClass('index-ad-fixed-on').siblings().removeClass('index-ad-fixed-on');
                obj.css({transform:'translate3d('+windowWidth/(-1)+'px,0px,0px)'});
                obj.children('a').first().remove().clone(true).appendTo(obj); 
                }) ; 
            }
             adTimer = setInterval( function() {
                showImg();
            } , 4000);
        }
    })($);
    var index = 0;
    $('.index-ad-slide').touchMove();
    $.autoPlay($('.index-ad-slide'));
    $('.index-ad-slide').on('touchstart' , function() {
        clearInterval(adTimer);
    }).on('touchend' , function() {
        $.autoPlay($('.index-ad-slide'));
    });
</script>
</html>