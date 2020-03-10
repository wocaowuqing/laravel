<?php
# 定义clientFds数组 保存所有websocket连接
$clientFds = [];

//创建websocket服务器对象，监听0.0.0.0:9502端口
$ws = new swoole_websocket_server("0.0.0.0", 9503);

//监听WebSocket连接打开事件
$ws->on('open', function ($ws, $request) use(&$clientFds) {
    // var_dump($request->fd, $request->get, $request->server);
    // $ws->push($request->fd, "hello, welcome\n");
    
});

//监听WebSocket http事件
$ws->on('request', function ($request, $response) use ($ws,&$clientFds) {
	//推送人信息
	$server=$request->server;

	//推送内容
	$getMsg=$request->get;
    $msg=json_decode($getMsg['msg'],true);
    $match_id=$msg['match_id'];
    $msg['type']='official';
    $msg=json_encode($msg);
    foreach($clientFds[$match_id] as $k=>$v){
    	foreach ($v as $k1 => $v1) {
    		$ws->push($k1, $msg);
    	}
    }
});

//监听WebSocket消息事件
$ws->on('message', function ($ws, $frame) use (&$clientFds) {
    // echo "Message: {$frame->data}\n";
    $data=json_decode($frame->data,true);
	// var_dump($data);
    //客户端id
    $id=$frame->fd;
    if ($data['type']=='entrance') {
    	$clientFds[$data['match_id']][]=[$id=>''];
    }if ($data['type']=='news') {
    	$data['phone']=substr($data['phone'],0,3)."****".substr($data['phone'],-4);
    	$json=json_encode($data);
    	foreach($clientFds[$data['match_id']] as $k=>$v){
    		foreach ($v as $k1 => $v1) {
    			$ws->push($k1, $json);
    		}
    	}
    }
});

//监听WebSocket连接关闭事件
$ws->on('close', function ($ws, $fd) use (&$clientFds) {
    // echo "client-{$fd} is closed\n";
	
    foreach($clientFds as $k=>$v){
    	foreach ($v as $k1 => $v1) {
    		foreach ($v1 as $k2 => $v2) {
    			if ($fd==$k2) {
    				unset($clientFds[$k][$k1]);
    			}
    		}
    	}
    }

});

$ws->start();
