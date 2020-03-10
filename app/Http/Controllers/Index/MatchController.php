<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\MatchModel;
class MatchController extends Controller
{
    public function match()
    {
        //查询所有比赛数据
        $matchInfo=MatchModel::select('match.match_id',
                                        'match.start_time',
                                        'match.end_time',
                                        'match.schedule',
                                        'match.team_one_min',
                                        'match.team_two_min',
                                        'match.is_win',
                                        'match.is_over',
                                        'tA.team_name as tA_name',
                                        'tB.team_name as tB_name')
                                ->join('team as tA','match.team_one',"=",'tA.team_id')
                                ->join('team as tB','match.team_two',"=",'tB.team_id')
                                ->orderby('match.start_time')
                                ->get()
                                ->toArray();
        //根据比赛时间分组
        // dd($matchInfo);
        $newInfo=[];//定义空的容器
        $nextData = [];//今天之后的比赛
        foreach($matchInfo as $k=>$v){
            $status=date("Ymd",$v['start_time']);//将时间变活，给时间分组
            //定义出比赛的几种状态 
            $matchStatus = 2;
            //未开始  当前时间<比赛的开始时间
            if(time() < $v['start_time']){
                $matchStatus = 1;
            }

            //直播中
            if(time() > $v['start_time'] && $v['is_over'] !=1){
                $matchStatus = 2;
            }
            //已结束
            if($v['is_over'] != 1){
                $matchStatus = 3;
            }
            $v['matchStatus'] = $matchStatus;
            //今天之后的比赛放到 nextData数组
            $time24 = strtotime(date("Ymd")) + 86400;
            if($v['start_time'] > $time24){
                $nextData[$status][] = $v;
            }else{
                $newInfo[$status][]=$v;
            }
            
        }
        // dd($newInfo);
        // dd($nextData);
        return view('index/match/match',['newInfo'=>$newInfo,'nextData'=>$nextData]);
    }
}
