@extends('layouts.admin')

@section('title', '球队添加')

@section('content')
	<h3>球队添加</h3>
	<br>
	<form action='{{url("team/create")}}' method="POST">
		<div class='div_basic div_form'>
			<div class="form-group">
				<label for="exampleInputEmail1">球队名称</label>
				<input type="text" class="form-control" name='team_name'>
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">小组选择</label>
				<select class="form-control" name='team_group'>
					<option value="A">A</option>
					<option value="B">B</option>
                    <option value="C">C</option>
					<option value="D">D</option>
				</select>
			</div>

			<div class="form-group">
				<label for="exampleInputEmail1">球队积分</label>
				<input type="text" class="form-control" name='team_min'>
			</div>
	
		</div>	
	

	  <button type="submit" class="btn btn-info" id='btn'>添加</button>
	</form>
@endsection