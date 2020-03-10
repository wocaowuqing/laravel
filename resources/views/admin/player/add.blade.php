@extends('layouts.admin')

@section('title', '球员添加')

@section('content')
	<h3>球员添加</h3>
	<br>
	<form action='{{url("player/create")}}' method="POST">
		<div class='div_basic div_form'>
			<div class="form-group">
				<label for="exampleInputEmail1">参赛球员</label>
				<input type="text" class="form-control" name='player_name'>
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">所属球队</label>
				
				<select class="form-control" name='team_id'>
					<option value='0'>请选择</option>
				@foreach($teamInfo as $v)
					<option value="{{$v->team_id}}">{{$v->team_name}}</option>
				@endforeach	
				</select>
			</div>
	
		</div>	
	

	  <button type="submit" class="btn btn-info" id='btn'>添加</button>
	</form>
@endsection