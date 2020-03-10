<?php

namespace App\Http\Controllers\Show;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\DataModel;
use App\Model\PlayerModel;
use App\Model\TeamModel;
class InformationController extends Controller
{
    public function information()
    {
        //个人排名
        $data = DataModel::select('team.team_name','player.player_name','data.help_num','data.bank_num',
                      \DB::raw('avg(score) as score,avg(help_num) as help_num,avg(bank_num) as bank_num'))
                    ->join('player','data.player_id','=','player.player_id')
                    ->join('team','player.team_id','=','team.team_id')
                    ->groupBy('player.player_id')
                    ->ORDERBY('score','desc')
                    ->get(); 
        // dd($data);
        foreach ($data as $k=>$v)
        {
            $player_id=$v['player_id'];
            // dd($player_id);
            $info = PlayerModel::join("team","player.team_id","=","team.team_id")
                ->where(["player_id"=>$player_id])
                ->get()
                ->toArray();
            // dd($info);
            foreach ($info as $key=>$val)
            {
                $data[$k]['player_name']=$val['player_name'];
                $data[$k]['team_name']=$val['team_name'];
            }
        }
        // dd($data);
        //球队排名
        $data1 = DataModel::select("team.team_group")
      		  ->join("player","player.player_id","=","data.player_id")
              ->join("team","team.team_id","=","player.team_id")
              ->get()
              ->toArray();
      	foreach ($data1 as $key => $value) {
      		$arr[]=$data1[$key]['team_group'];
      		$new_arr=array_unique($arr);
      		
      	}
        return view('show/information/information',['data'=>$data,"new_arr"=>$new_arr]);
    }

    //排名信息
    public function ranking(Request $request)
    {
        $team_group = $request->input('team_group');
        // dd($team_group);
        $info = TeamModel::select()
            ->where(["team_group"=>$team_group])
            ->ORDERBY("team_min","desc")
            ->get()
            ->toArray();
        // dd($info);

        return view('show/information/ranking',['info'=>$info,"team_group"=>$team_group]);
    }
}