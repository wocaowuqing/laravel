
@extends('layouts.admin')
@section('title')
消息推送
@endsection
@section('content')
@foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(session()->has($msg))
        <div class="flash-message">
            <p class="alert alert-{{ $msg }}">
                {{ session()->get($msg) }}
            </p>
        </div>
    @endif
@endforeach
<link rel="stylesheet" href="/imgUpload/public/index.css">
<form action="{{url('good/store')}}" method="post">
    <table border="1" align="center">
      <div class="form-group">
        <label for="cate_tel" class="col-sm-2 control-label">比赛：</label>
        <div class="col-sm-13">
            <select name="match_id" style="width: 200px">
                <option value="">请选择</option>
              @foreach($info as $v)
                <option value="{{$v->match_id}}" @if($v->match_id==$match_id) selected @endif>{{$v->ta_name}}VS{{$v->tb_name}}</option>
              @endforeach
            </select>
        </div>
      </div>

        <div class="form-group" >
            <label for="cate_tel" class="col-sm-2 control-label">推送类型：</label>
            <div class="col-sm-13">
                <select name="push_id" style="width: 200px">
                    <option value="">请选择</option>
                    <option value="1">节</option>
                    <option value="2">球队</option>
                    <option value="3">解说</option>
                </select>
            </div>
        </div>

        <div id="push">
            
        </div>
      <!-- <div class="form-group">
        <label for="cate_tel" class="col-sm-2 control-label">消息：</label>
        <div class="col-sm-5">
            <textarea class="form-control" name="msg" id="msg" rows="3"></textarea>
        </div>
      </div> -->

        
        <div class="form-group">
                <label for="cate_password1" class="col-sm-0 control-label"></label>
                <div class="col-sm-8">
                    <button type="submit" class="btn btn-info" id="tj">提交</button>
                </div>
            </div>
    </table>
</form>
<script>
$(function(){
    var match_id=$('select[name="match_id"]').val();
    $('select[name="push_id"]').change(function(){
        $('#push').empty()
        var push_id=$(this).val()
        if (push_id==1) {
            //节
            $.ajax({
                method: "get",
                url: "/good/node",
                data: {match_id:match_id},
                dataType:'json'
            }).done(function( msg ) {
                if (msg.code==1) {
                    $('#push').append('<div class="form-group">\
                        <label for="admin_name" class="col-sm-2 control-label">节：</label>\
                        <div class="col-sm-8">\
                            <input type="text" class="form-control" name="node" value="'+msg.node+'" />\
                        </div>\
                    </div>')
                }
            })
            

        }else if (push_id==2){
            $.ajax({
                method: "get",
                url: "/good/team",
                data: {match_id:match_id},
                dataType:'json'
            }).done(function( msg ) {
                console.log(msg.msg)
                if (msg.code==1) {
                    $('#push').append('<div class="form-group" >\
                        <label for="cate_tel" class="col-sm-2 control-label">球队：</label>\
                        <div class="col-sm-13">\
                            <select name="msg_name" style="width: 200px">\
                                <option value="">请选择</option>\
                                <option value="'+msg.msg.teamAname+'">'+msg.msg.teamAname+'</option>\
                                <option value="'+msg.msg.teamBname+'">'+msg.msg.teamBname+'</option>\
                            </select>\
                        </div>\
                    </div>')
                    $('#push').append('<div class="form-group">\
                        <label for="cate_tel" class="col-sm-2 control-label">消息：</label>\
                        <div class="col-sm-5">\
                            <textarea class="form-control" name="msg" id="msg" rows="3"></textarea>\
                        </div>\
                    </div>')
                }
            });
        }else if(push_id==3){
            $('#push').append('<div class="form-group" >\
                <label for="cate_tel" class="col-sm-2 control-label">解说员：</label>\
                <div class="col-sm-13">\
                    <select name="msg_name" style="width: 200px">\
                        <option value="">请选择</option>\
                        <option value="治军之道">治军之道</option>\
                        <option value="隔壁老王">隔壁老王</option>\
                    </select>\
                </div>\
            </div>')
            $('#push').append('<div class="form-group">\
                <label for="cate_tel" class="col-sm-2 control-label">消息：</label>\
                <div class="col-sm-5">\
                    <textarea class="form-control" name="msg" id="msg" rows="3"></textarea>\
                </div>\
            </div>')
        }
    })



    $('#but').click(function(){
        var match_id=$('select[name="match_id"]').val()
        var push_id=$('select[name="push_id"]').val()
        var msg=$('#msg').val()
        console.log(match_id+'|'+push_id+'|'+msg)
        if (match_id=='' || push_id=='' || msg=='') {
            alert('不能为空');
            return 
        }

        $.ajax({
            method: "get",
            url: "http://39.105.74.143:9501",
            data: {push_id:push_id,match_id:match_id,msg:msg}
        }).done(function( msg ) {
            $('#msg').empty()
        });
    })
})
</script>
<script src="/imgUpload/public/index.js"></script>
<script>
$(function(){
    var img2 = new ImgUpload('.imgLog2',100,100,100);

    $(document).on('change',".imgLog2 input",function(e){
        //模拟后台返回url
        var url = window.URL.createObjectURL(e.target.files[0]);
        $(this).parent().css('background','url('+url+')0% 0% / cover')
        img2.setSpan(this)
    })
})
</script>
@endsection