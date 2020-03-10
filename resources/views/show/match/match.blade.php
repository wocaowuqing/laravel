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
	<link rel="stylesheet" href="/show/css/reset.css">
	<link rel="stylesheet" href="/show/css/Match.css">
</head>
<body>
	<div class="content">
		<header class="header">
			<a href="index"></a>
			<span>比赛</span>
		</header>
		<section class="Match_section" id="wrapper">
			<div id="scroller">
				<div id="pullDown">
					<span class="pullDownIcon"></span><span class="pullDownLabel">下拉刷新...</span>
				</div>
				<div class="news-lists" id="news-lists">
					<div class="Match_used"></div>
					<div class="Match_new"></div>
				</div>
				<div id="pullUp">
					<span class="pullUpIcon"></span><span class="pullUpLabel">上拉加载更多...</span>
				</div>
			</div>
		</section>	
		<div id="dv1"><img src="/show/images/up.png"></div>
	</div>
	
</body>
<script src="/show/js/iscroll.js"></script>
<script type="text/javascript" src="/show/js/zepto.min.js"></script>
<script type="text/javascript" src="/show/js/fx.js"></script>
<script type="text/javascript" src="/show/js/touch.js"></script>
<script type="text/javascript" src="/show/js/refresh.js"></script>
<script type="text/javascript" src="/show/data/data.js"></script>
<script type="text/javascript">

	//页面赋值
	var before_data = <?php echo json_encode($beforeData)?>;
	var now_data = <?php echo json_encode($nowData)?>;
    document.documentElement.style.fontSize=document.documentElement.clientWidth/24+'px';
   	var beforeIndex = 0;
    function before() {
    	 var ii = 1;
    	var str="";
    	var num=0;
	   	for(var j in before_data){
	   		num++;
	   		if(j < beforeIndex){

	        }else{
                if(ii > parseInt(beforeIndex)+4){
                    break;
                }
		        var before_day = before_data[j];
		        var week_1="";
		    	var week = before_day.week;
			    for(var j in week){
			        var week_1 = "";
			        if(week[j] == "1"){
			            week_1 = "星期一";
			        }else if(week[j] == "2"){
			            week_1 = "星期二";
			        }else if(week[j] == "3"){
			            week_1 = "星期三";
			        }else if(week[j] == "4"){
			            week_1 = "星期四";
			        }else if(week[j] == "5"){
			            week_1 = "星期五";
			        }else if(week[j] == "6"){
			            week_1 = "星期六";
			        }else if(week[j] == "7"){
			            week_1 = "星期日";
			        }
			    }
		        str1 = "<div class='Match_time'>"+
		        		//以前时间
						"<h1>"+before_day.day+"<span>/"+before_day.month+"</span><i>"+week_1+"</i></h1>"+
								"<div class='Match_table'>"+
				                    "<table>"+
				                        "<tbody>";
				                        for(var n in before_day.data){
				                          str1+="<tr>"+
				                                "<td>"+before_day.data[n].tA_name+"<br/>"+before_day.data[n].tB_name+"</td>"+
				                                "<td><em>"+before_day.data[n].team_one_min+"<br/>"+before_day.data[n].team_two_min+"</em></td>"+
				                                "<td>已结束</td>"+
				                                "<td><p class='count' match_id="+before_day.data[n].match_id+" data-id="+before_day.data[n].teamAid+" dete-id="+before_day.data[n].teamBid+" tA_name="+before_day.data[n].tA_name+" tB_name="+before_day.data[n].tB_name+" team_one_min-id="+before_day.data[n].team_one_min+" team_two_min-id="+before_day.data[n].team_two_min+">技术统计<i></i></p></td>"+
				                            "</tr>";
				                        }
				                        str1+="</tbody>"+
				                    "</table>"+
				                "</div>"+
					"</div>";
				str = str1+str;
					ii++;
		    }  
		}
		beforeIndex+=4;
		$(".Match_used").html(str);
		var target = $(".Match_time").length;
            if(target ==num){
                $(".pullDownIcon").hide();
                $(".pullDownLabel").html("全部加载完毕....");
            }else{
            	$("#pullDown").show();
            }
        $(".count").on("click",function(){
        	//id
        	var id = $(this).attr("match_id");
			// console.log(id);
	    	//teamAid
	    	var teamAid = $(this).attr("data-id");
			// console.log(teamAid);
	    	var tA_name = $(this).attr("tA_name");
	    	var team_one_min = $(this).attr("team_one_min-id");
	    	//teamBid
	   		var teamBid = $(this).attr("dete-id");
	   		var tB_name = $(this).attr("tB_name");
	   		var team_two_min = $(this).attr("team_two_min-id");
	   		$.ajax({
	             type: "post",
	             url: "/shop/count",
	             data: {id:id},
	             dataType: "json",
	             success: function(res){
	                if(res.ret==1){
	                   location.href = "/shop/countshow"+'?id='+id+'&teamAid='+teamAid+'&tA_name='+tA_name+'&team_one_min='+team_one_min+'&teamBid='+teamBid+'&tB_name='+tB_name+'&team_two_min='+team_two_min;
	                }else{
	   					myalert(res.msg);
	                }
	             }
	        })
	    })
    }
    var nowIndex = 0;
    now();
    function now() {
    	var ii = 1;
    	var str="";
    	var num1=0;
	   	for(var j in now_data){
	   		num1++;
	   		if(j < nowIndex){
                            
            }else{
                if(ii > parseInt(nowIndex)+4){
                    break;
                }
		        var now_day = now_data[j];
		        var week_1="";
		    	var week = now_day.week;
			    for(var j in week){
			        var week_1 = "";
			        if(week[j] == "1"){
			            week_1 = "星期一";
			        }else if(week[j] == "2"){
			            week_1 = "星期二";
			        }else if(week[j] == "3"){
			            week_1 = "星期三";
			        }else if(week[j] == "4"){
			            week_1 = "星期四";
			        }else if(week[j] == "5"){
			            week_1 = "星期五";
			        }else if(week[j] == "6"){
			            week_1 = "星期六";
			        }else if(week[j] == "7"){
			            week_1 = "星期日";
			        }
			    }
		        str+="<div class='Match_box'>"+
		        		//以前时间
						"<h1>"+now_day.day+"<span>/"+now_day.month+"</span><i>"+week_1+"</i></h1>"+
								"<div class='table'>"+
				                    "<table>"+
				                        "<tbody>";
				                        for(var i in now_day.data){
				                        	
				                        	if(now_day.data[i].matchStatus == "3"){
				                        		str+="<ul class='Match_table_tr'>"+
					                                "<li>"+now_day.data[i].tA_name+"<br/>"+now_day.data[i].tB_name+"</li>"+
					                                "<li><em>"+now_day.data[i].team_one_min+"<br/>"+now_day.data[i].team_two_min+"</em></li>"+
					                                "<li>已结束</li>"+
					                                "<li><p class='count' id="+now_day.data[i].id+" data-id="+now_day.data[i].teamAid+" dete-id="+now_day.data[i].teamBid+" tA_name="+now_day.data[i].tA_name+" tB_name="+now_day.data[i].tB_name+" team_one_min-id="+now_day.data[i].team_one_min+" team_two_min-id="+now_day.data[i].team_two_min+">技术统计<i></i></p></li>"+
					                            "</ul>";
				                        	}else if(now_day.data[i].matchStatus == "1"){
				                        		str+="<tr>"+
					                                "<td>"+now_day.data[i].time+"</td>"+
					                                "<td>"+now_day.data[i].tA_name+"<br/>"+now_day.data[i].tB_name+"</td>"+
					                                "<td><em>未开始</em></td>"+
					                            "</tr>";
				                        	}else if(now_day.data[i].matchStatus == "2"){
				                        		str+="<ul class='Match_table_tr'>"+
					                                "<li>"+now_day.data[i].tA_name+"<br/>"+now_day.data[i].tB_name+"</li>"+
					                                "<li><em>"+now_day.data[i].team_one_min+"<br/>"+now_day.data[i].team_two_min+"</em></li>"+
					                                "<li>已开始</li>"+
					                                "<li><p style='background:red'>前往直播 <i></i></p></li>"+
					                            "</ul>";
				                        	}
				                        }
				                        str+="</tbody>"+
				                    "</table>"+
				                "</div>"+
					"</div>";
				ii++;
			}
	    }
	    nowIndex+=4;
		$(".Match_new").html(str);
        var target = $(".Match_box").length;
        if(target ==num1){
            $("#pullUp").hide();
        }else{
        	$("#pullUp").show();
        }
    }
    $("#dv1").on("click",function(){
    	$("#scroller").animate({"transform":"translate(0px,-50px) scale(1) translateZ(0px)"},100)
    })

    function myalert(msg,redirect){
	 	$(".box_bg").css("display","block");
	 	popTipShow.alert('暂无数据',msg, ['知道了'],
			function(e){
			  //callback 处理按钮事件		  
			  var button = $(e.target).attr('class');
			  if(button == 'ok'){
				//按下确定按钮执行的操作
				//todo ....
				this.hide();
				$(".box_bg").css("display","none");
				if(redirect == 1){
					location.href = location.href;
				}
			  }	
			}
		);
	 }
</script>
</html>