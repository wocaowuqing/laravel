@extends('layouts.admin')

<script src="/hadmin/js/jquery-3.2.1.min.js"></script>
@section('title', '轮播图展示')
@section('content')
<table class="table table-bordered">
        <tr>
            <td>ID</td>
            <td>图片名称</td>
            <td>图片</td>
            <td>是否展示</td>
            <td>操作</td>
        </tr>
    @foreach($data as $v)
    <tr>
        <td>{{$v->wheel_id}}</td>
        <td>{{$v->wheel_name}}</td>
        <td><img src="/{{$v->wheel_img}}" width="100px"></td>
        <td><span id="span" field="is_show" wheel_id={{$v->wheel_id}}>{{$v->is_show==1?'√' : '×'}}</span></td>
        <td>
            <a href="javascript:;" class="btn btn-info">编辑</a>|
            <a href="javascript:;" class="btn btn-danger">删除</a>
        </td>
    </tr>
    @endforeach
</table>
{{ $data->links() }}
<script>
    $(document).on("click","#span",function(){
        var _this=$(this);
        var wheel_id=_this.attr('wheel_id');
        var field=_this.attr('field');
        var is_show=_this.html();
        // alert(is_show);return;
        if(is_show=='√'){
				var is_show=2;
				var flag='×';
			}else{
				var is_show=1;
				var flag='√';
			}
        $.ajax({
            type: "POST",
            url: "{{url('wheel/upd')}}",
            data: {wheel_id:wheel_id,is_show:is_show,field:field},
            dataType: "json",
            success: function (res) {
                if(res.code==2){
						alert(res.font);
					}else{
						_this.html(flag);
					}
            }
        });
    });
   </script>
@endsection