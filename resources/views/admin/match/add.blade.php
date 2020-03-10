@extends('layouts.admin')

@section('title', '赛程添加')
<link rel="stylesheet" href="/hadmin/time/dateTime.css">
	<style>
		.mycontainer input{
			border:1px solid #ccc;
			padding:6px 10px;
		}
	</style>



	<script src="https://www.jq22.com/jquery/jquery-1.10.2.js"></script>
	<script src="/hadmin/time/dateTime.min.js"></script>

@section('content')
	<h3>赛程添加</h3>
	<br>
	<form action='{{url("match/create")}}' method="POST">
		<div class='div_basic div_form'>
			<div class="form-group">
				<label for="exampleInputEmail1">赛程点</label>
				<input type="text" class="form-control" name='schedule'>
			</div>

			<div class="form-group">
				<label for="exampleInputEmail1">参赛球队1</label>
				
				<select class="form-control" name='team_one'>
					<option value='0'>请选择</option>
				@foreach($teamInfo as $v)
					<option value="{{$v['team_id']}}">{{$v['team_name']}}</option>
				@endforeach
				</select>
			</div>

			<div class="form-group">
				<label for="exampleInputEmail1">参赛球队2</label>
				
				<select class="form-control" name='team_two'>
					<option value='0'>请选择</option>
				@foreach($teamInfo as $v)
					<option value="{{$v['team_id']}}">{{$v['team_name']}}</option>
				@endforeach
				</select>
			</div>

			<!-- <div class="form-group">
				<label for="exampleInputEmail1">比赛时间</label>
				<input type="datetime-local" class="form-control" >
			</div> -->

			<div class="form-group">
				<label for="exampleInputEmail1">比赛时间</label>
				<input type="text" class="form-control"  placeholder="请选择日期和时间" name='start_time' id="datetime">
			</div>

			<!-- <div class="form-group">
				<label for="exampleInputEmail1">结束时间</label>
				<input type="text" class="form-control"  placeholder="请选择日期和时间" name='end_time' id="endtime">
			</div> -->

			
			<!-- <div class="form-group">
				<label for="exampleInputEmail1">球队1比分</label>
				<input type="text" class="form-control" name='team_one_min'>
			</div>

			<div class="form-group">
				<label for="exampleInputEmail1">球队2比分</label>
				<input type="text" class="form-control" name='team_two_min'>
			</div>

			<div class="form-group">
				<label for="exampleInputEmail1">胜负</label>
				<input type="text" class="form-control" name='is_win'>
			</div> -->
			<div class="form-group">
				<label for="exampleInputEmail1">是否结束</label>
				<input type="radio" name="is_over" value="1" checked>是
				<input type="radio" name="is_over" value="2">否
			</div>
		</div>	
	  <button type="submit" class="btn btn-info" id='btn'>添加</button>
	</form>
<script>
	$("#datetime").datetime({
		type:"datetime",
		value:[2019,7,15,15,30]
	})
	$("#endtime").datetime({
		type:"datetime",
		value:[2019,7,15,15,30]
	})
</script>
	<script>
		window.onload=function(){
			var totleTp = 0;
			var tppiao = document.getElementsByClassName("tppiao");
			for(var i=0;i<tppiao.length;i++){totleTp+=parseInt(tppiao[i].innerHTML);}
			var tpdetial = document.getElementsByClassName("tpdetial");
			for(var i=0;i<tpdetial.length;i++){var mun = parseInt(tpdetial[i].getElementsByClassName("tppiao")[0].innerHTML);var bfb = (mun*100/totleTp).toFixed(2)+"%";tpdetial[i].getElementsByClassName("tppercent")[0].innerHTML = bfb;
			}
		}
		if(window.location.href.indexOf("udsid=")>-1){
			$("#ctlNext").on("click",function(){
				console.log("执行成功！")
				meteor.track("form", {convert_id: "1641358861914125"})
			})
		}
	</script>
@endsection