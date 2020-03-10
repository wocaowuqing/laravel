@extends('layouts.admin')

@section('title', '商品展示')

@section('content')
<table class="table table-bordered" id="AttriTable">
        <tr>
            <td><input type="checkbox" id="boxAll"></td>
            <td>ID</td>
            <td>球队名称</td>
            <td>分组</td>
            <td>球员分配</td>
            <td>积分</td>
            <td>操作</td>
        </tr>
        @foreach($teamInfo as $v)
        <tr class='tr'>
            <td><input type="checkbox" class='box'></td>
            <td>{{$v->team_id}}</td>
            <td>{{$v->team_name}}</td>
            <td>{{$v->team_group}}</td>
            <td><a href="{{url('player/add',['team_id'=>$v->team_id])}}" class="btn btn-info">分配球员</a></td>
            <td>{{$v->team_min}}</td>
            <td>
                <a href="javascript:;" class="btn btn-info">编辑</a>|
                <a href="javascript:;" class="btn btn-danger">删除</a>
            </td>
        </tr>
        @endforeach
    </table>
    {{ $teamInfo->links() }}
<!-- <script>
    $(function(){
        /**
        *   既点既改
        */
        //点击
        $(document).on('click','.clk',function(){
            $(this).hide().next().show();
        });
        //失焦
        $(document).on('blur','.changeValue',function(){
            var _this=$(this);
            //获取新值、字段、id
            var value=_this.val();
            // console.log(goods_name);
            var field=_this.parent().attr('field');
            var goods_id=_this.parents('tr').attr('goods_id');
            $.ajax({
                url:"changeValue",
                method:"POST",
                data:{value:value,field:field,goods_id:goods_id},
                dataType:'json',
                success:function(res){
                    console.log(res);
                }
            });
            _this.hide();
            _this.prev('span').html(value).show();
        });
    });
</script> -->
    <!-- 内容结束 -->
@endsection