@extends('layouts.admin')

@section('title', '比赛数据添加')

@section('content')
	<h3>比赛数据添加</h3>
	<br>
	<form action='{{url("data/create")}}' method="POST">
		<div class='div_basic div_form'>
		
			<div class="form-group">
				<label for="exampleInputEmail1">对阵球队</label>
			 	<br>
				@foreach($matchInfo as $v)
					<input type="text" name="match_id" value="{{$v['match_id']}}">
					<h2><b>{{$v['tA_name']}}  <span style="color:red;"> VS </span>  {{$v['tB_name']}}</b></h2>
				@endforeach
			</div>

			<div class="form-group">
				<label for="exampleInputEmail1">球员选择</label>
				<select name="player_id" id="" class="form-control">
					<option value="0">球员选择</option>
				@foreach($playerInfo as $v)
					<option value="{{$v['player_id']}}">{{$v['player_name']}}</option>
				@endforeach
				</select>
			</div>

			<div class="form-group">
				<label for="exampleInputEmail1">得分</label>
				<input type="text" class="form-control" name='score'>
			</div>

			<div class="form-group">
				<label for="exampleInputEmail1">助攻</label>
				<input type="text" class="form-control" name='help_num'>
			</div>

			<div class="form-group">
				<label for="exampleInputEmail1">篮板</label>
				<input type="text" class="form-control" name='bank_num'>
			</div>
		</div>	
	  <button type="submit" class="btn btn-default" id='btn'>添加</button>
	</form>
@endsection
