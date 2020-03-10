<?php

namespace App\Http\Controllers\goods;
use App\Model\MatchModel;
use App\Model\MsgModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    /*
    |推送类型 
    |   第几节-时间 node
    |   队伍->      team
    |       时间-信息
    |   名-(评论员) commentator
    |       时间-信息
     */
    public function create(Request $request){
    	$match_id=$request->match_id;

    	$info=MatchModel::select('match.match_id','ta.team_name as ta_name','tb.team_name as tb_name')
    		->join('team as ta','match.team_one','=','ta.team_id')
    		->join('team as tb','match.team_two','=','tb.team_id')
    		->get();

    	return view('good.create',['info'=>$info,'match_id'=>$match_id]);
    }

    public function store(Request $request){
    	$data=$request->input();
        $time=MsgModel::where([['match_id',$data['match_id']],['push_id',1]])->orderBy('msg_id','desc')->value('time');
       
        
        $data['time']=time();
        if ($data['push_id']==1) {
            if ($data['node']=='第一节') {
                $data['node']=1;
            }else if($data['node']=='第二节') {
                $data['node']=2;
            }else if($data['node']=='第三节') {
                $data['node']=3;
            }else if($data['node']=='第四节') {
                $data['node']=4;
            }
        }
        @file_get_contents($url);
        $res=MsgModel::create($data);
    	$url="http://47.96.232.68:9503?msg=".json_encode($data);
    	// dd($url);
    	
        if ($res) {
            return redirect()->back()->with('success','推送成功');;
        }else{
            return redirect()->back()->with('danger','推送失败');
        }
    }

    public function node(Request $request){
        $match_id=$request->match_id;
        $node=MsgModel::where([['match_id',$match_id],['push_id',1]])->orderBy('msg_id','desc')->value('node');
        if (!$node) {
            $node='第一节';
        }else if($node==1){
            $node='第二节';
        }else if($node==2){
            $node='第三节';
        }else if($node==3){
            $node='第四节';
        } 
        echo json_encode(['code'=>1,'node'=>$node]);

    }

    public function team(Request $request){
        $match_id=$request->match_id;
        $data=MatchModel::
            select(
                'ta.team_name as teamAname',
                'tb.team_name as teamBname',
            )
            ->join("team as ta","match.team_one",'=','ta.team_id')
            ->join("team as tb",'match.team_two','=','tb.team_id')
            ->where('match_id',$match_id)
            ->get()
            ->toArray();
        if (!$data) {
            echo json_encode(['code'=>'2','msg'=>'无']);exit;
        }
        echo json_encode(['code'=>'1','msg'=>$data[0]]);exit;
    }
}
