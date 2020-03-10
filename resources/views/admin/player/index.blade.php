@extends('layouts.admin')

@section('title', '商品展示')

@section('content')
<table class="table table-bordered" id="AttriTable">
        <tr>
            <td><input type="checkbox" id="boxAll"></td>
            <td>ID</td>
            <td>球员</td>
            <td>所属球队</td>
            <td>操作</td>
        </tr>
        @foreach($playerInfo as $v)
        <tr class='tr'>
            <td><input type="checkbox" class='box'></td>
            <td>{{$v->player_id}}</td>
            <td>{{$v->player_name}}</td>
            <td>{{$v->team_name}}</td>
            <td>
                <a href="javascript:;" class="btn btn-info">编辑</a>|
                <a href="javascript:;" class="btn btn-danger">删除</a>
            </td>
        </tr>
        @endforeach
</table>
{{ $playerInfo->links() }}

    <!-- 内容结束 -->
@endsection