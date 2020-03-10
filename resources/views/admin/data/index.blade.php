@extends('layouts.admin')

@section('title', '数据展示')

@section('content')
<table class="table table-bordered" id="AttriTable">
        <tr>
            <td><input type="checkbox" id="boxAll"></td>
            <td>ID</td>
            <td>对阵球队</td>
            <td>对阵时间</td>
            <td>球员</td>
            <td>得分</td>
            <td>助攻</td>
            <td>篮板</td>
            <td>操作</td>
        </tr>
        @foreach($data as $v)
        <tr class='tr'>
            <td><input type="checkbox" class='box'></td>
            <td>{{$v['data_id']}}</td>
            <td>
                {{$v['tA_name']}}
                    <b style="color:red;">VS</b>    
                {{$v['tB_name']}} 
            </td>
            <td>{{date('Y-m-d H:i:s',$v['start_time'])}}</td>
            <td>{{$v['player_name']}}</td>
            <td>{{$v['score']}}</td>
            <td>{{$v['help_num']}}</td>
            <td>{{$v['bank_num']}}</td>
            <td>
                <a href="javascript:;" class="btn btn-info">编辑</a>|
                <a href="javascript:;" class="btn btn-danger">删除</a>
            </td>
        </tr>
        @endforeach
</table>
{{ $data->links() }}

    <!-- 内容结束 -->
@endsection