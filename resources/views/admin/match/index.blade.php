@extends('layouts.admin')

@section('title', '比赛展示')

@section('content')
<table class="table table-bordered" id="AttriTable">
        <tr>
            <td><input type="checkbox" id="boxAll"></td>
            <td>ID</td>
            <td>赛程</td>
            <td>球队1</td>
            <td>球队2</td>
            <td>开赛时间</td>
            <!-- <td>结束时间</td>
            <td>球队1比分</td>
            <td>球队2比分</td> -->
            <td>直播情况</td>
            <td>数据添加</td>
            <td>操作</td>
        </tr>
        @foreach($matchInfo as $v)
        <tr class='tr'>
            <td><input type="checkbox" class='box'></td>
            <td>{{$v['match_id']}}</td>
            <td>{{$v['schedule']}}</td>
            <td>{{$v['tA_name']}}</td>
            <td>{{$v['tB_name']}}</td>
            <td>{{date("Y-m-d H:i:s",$v['start_time'])}}</td>
            <!-- <td>{{date("Y-m-d H:i:s",$v['end_time'])}}</td>
            <td>{{$v['team_one_min']}}</td>
            <td>{{$v['team_two_min']}}</td> -->
            <td>{{$v['is_over']}}</td>
            <td>
                <a href="{{url('data/add',['match_id'=>$v['match_id']])}}" class="btn btn-info">数据添加</a>
            </td>
            <td>
                <a href="javascript:;" class="btn btn-info">编辑</a>|
                <a href="javascript:;" class="btn btn-danger">删除</a>
            </td>
        </tr>
        @endforeach
</table>
{{ $matchInfo->links() }}

    <!-- 内容结束 -->
@endsection