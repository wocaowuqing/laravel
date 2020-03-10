<?php

namespace App\Http\Controllers\Show;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\MatchModel;
use App\Model\DataModel;
use App\Model\PlayerModel;
class MatchController extends Controller
{
    public function match()
    {
        //查询所有的比赛 根据时间分组
        $data = MatchModel::select('match.match_id',
                'match.start_time',
                'match.end_time',
                'match.schedule',
                'match.team_one_min',
                'match.team_two_min',
                'match.is_over',
                'tA.team_name as tA_name',
                'tB.team_name as tB_name')
                ->join('team as tA','match.team_one',"=",'tA.team_id')
                ->join('team as tB','match.team_two',"=",'tB.team_id')
                ->orderby('match.start_time')
                ->get()
                ->toArray();
        // dd($data);
        //因为页面通过俩个结构渲染的数据 => 将数组处理成俩个结构
        //今天开始的比赛 就是(今天和今天过后的)
        //今天之前的比赛 就是(昨天之前)
        $nowData = $beforeData = [];
        // dd($nowData);
        foreach($data as $key=>$value){
            //得到日期
            $beginDay = date('Ymd',$value['start_time']);
            // dd($beginDay);
            //加入几种比赛状态用于页面渲染 未开始 直播中 已结束
            $matchStatus = 1; //属于未开始
            
            if(time() < $value['start_time'] && $value['is_over'] !=1){
                $matchStatus = 2;
            }

            if($value['is_over'] == 3){
                $matchStatus = 3;  //已结束 
            }
            //加入俩个字段
            $value['matchStatus'] = $matchStatus;
            $value['time'] = date("H:i",$value['start_time']);

            //判断放到今天开始的比赛  还是今天之前的比赛
            //比赛时间 小于今天的0点
            $time0 = strtotime(date("Y-m-d"));
            // dd($time0);
            if($value['start_time'] < $time0){
                $beforeData[$beginDay]['month'] = date("d",strtotime($beginDay));
                $beforeData[$beginDay]['day'] = date("n",strtotime($beginDay));
                $beforeData[$beginDay]['week'] = date("w",strtotime($beginDay));
                $beforeData[$beginDay]['data'][] = $value;
            }else{
                $nowData[$beginDay]['month'] = date("d",strtotime($beginDay));
                $nowData[$beginDay]['day'] = date("n",strtotime($beginDay));
                $nowData[$beginDay]['week'] = date("w",strtotime($beginDay));
                $nowData[$beginDay]['data'][] = $value;
            }
        }
        // dd($beforeData);
        $beforeData = array_reverse($beforeData);
        // dd($beforeData);
        return view('show/match/match',['nowData'=>$nowData,'beforeData'=>$beforeData]);
    }

    public function count(Request $request)
    {
        // echo 111;die;
        $match_id = $request->id;
        // dd($match_id);
        $res = MatchModel::where('match_id',$match_id)->count();
        // dd($res);
        if($res == 1){
            echo json_encode(['ret'=>1,'msg'=>'有']);die;
        }else{
            echo json_encode(['ret'=>2,'msg'=>'无']);die;
        }
    }

    public function countshow(Request $request)
    {
        $match_id = $request->id;
        // dd($match_id);
        $data = MatchModel::select(
                'match.match_id',
                'match.start_time',
                'match.end_time',
                'match.schedule',
                'match.team_one',
                'match.team_two',
                'match.team_one_min',
                'match.team_two_min',
                'match.is_over',
                'tA.team_name as tA_name',
                'tB.team_name as tB_name')
                ->join('team as tA','match.team_one',"=",'tA.team_id')
                ->join('team as tB','match.team_two',"=",'tB.team_id')
                ->where(['match_id'=>$match_id])
                ->first()
                ->toArray();
        // dd($data);
        // $latestPost = DataModel::where('match_id',$match_id);
        // dd($latestPost);
        // $playerAData = PlayerModel::leftJoinSub($latestPost,'data',function($join){
        //     $join->on('player.player_id','=','data.player_id');
        // })
        //     ->where('player.team_id',$data['team_one'])
        //     ->get()
        //     ->toArray();
        // dd($playerAData);
        // $playerBData = PlayerModel::leftJoinSub($latestPost,'data',function($join){
        //     $join->on('player.player_id','=','data.player_id');
        // })
        //     ->where('player.team_id',$data['team_two'])
        //     ->get()
        //     ->toArray();
        // dd($playerBData);
        $playerAData = DataModel::rightJoin("player",'data.player_id','=','player.player_id')
                    ->where(['player.team_id'=>$data['team_one']])
                    ->where(function ($query) use ($match_id){
                        $query->where("data.match_id",$match_id)
                        ->orWhere("data.match_id",null);
                    })
                    ->get()
                    ->toArray();
        // dd($playerAData);
        $playerBData = DataModel::rightJoin("player",'data.player_id','=','player.player_id')
                    ->where(['player.team_id'=>$data['team_two']])
                    ->where(function ($query) use ($match_id){
                        $query->where("data.match_id",$match_id)
                        ->orWhere("data.match_id",null);
                    })
                    ->get()
                    ->toArray();
        // dd($playerBData);
        //查询A队B队数据
        $data['countA_score'] = 0;
        $data['countA_help_num'] = 0;
        $data['countA_bank_num'] = 0;
        $data['countB_score'] = 0;
        $data['countB_help_num'] = 0;
        $data['countB_bank_num'] = 0;
        //处理A
        foreach($playerAData as $k=>$v){
            $playerAData[$k]['score'] = is_null($v['score']) ? 0 : $v['score'];
            $playerAData[$k]['help_num'] = is_null($v['help_num']) ? 0 : $v['help_num'];
            $playerAData[$k]['bank_num'] = is_null($v['bank_num']) ? 0 : $v['bank_num'];
            //计算总和
            $data['countA_score'] +=$v['score'];
            $data['countA_help_num'] +=$v['help_num'];
            $data['countA_bank_num'] +=$v['bank_num'];
        }
        //处理B
        foreach($playerBData as $k=>$v){
            $playerBData[$k]['score'] = is_null($v['score']) ? 0 : $v['score'];
            $playerBData[$k]['help_num'] = is_null($v['help_num']) ? 0 : $v['help_num'];
            $playerBData[$k]['bank_num'] = is_null($v['bank_num']) ? 0 : $v['bank_num'];
            //计算总和
            $data['countB_score'] +=$v['score'];
            $data['countB_help_num'] +=$v['help_num'];
            $data['countB_bank_num'] +=$v['bank_num'];
        }
        return view('show/count/countshow',['data'=>$data,'playerAData'=>$playerAData,'playerBData'=>$playerBData]);
    }
}