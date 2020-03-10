<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\DataModel;
use App\Model\PlayerModel;
use App\Model\MatchModel;
use Illuminate\Support\Facades\DB;
class DataController extends Controller
{
    public function add($id='')
    {
        //获取比赛队伍
        $matchInfo=MatchModel::select('match.match_id','tA.team_name as tA_name','tB.team_name as tB_name')
                                ->join('team as tA','match.team_one',"=",'tA.team_id')
                                ->join('team as tB','match.team_two',"=",'tB.team_id')
                                ->where('match_id',$id)
                                ->get()
                                ->toArray();
        // var_dump($matchInfo);exit;
        //获取比赛成员
        $teamInfo=MatchModel::where('match_id',$id)->first();
        $teamA=$teamInfo['team_one'];
        $teamB=$teamInfo['team_two'];
        $teamA_Info=PlayerModel::join('team','player.team_id','team.team_id')
        ->where('player.team_id',$teamA)->get()->toArray();
        $teamB_Info=PlayerModel::join('team','player.team_id','team.team_id')
        ->where('player.team_id',$teamB)->get()->toArray();
        $playerInfo=array_merge($teamA_Info,$teamB_Info);

        return view('admin/data/add',['playerInfo'=>$playerInfo,'matchInfo'=>$matchInfo]);
    }

    public function create()
    {
        
        $data = request()->all();
        $res = DataModel::create($data);
        if($res){
            echo "<script>alert('添加成功');location.href='http://ww.wen5211314.com/data/index'</script>";
        }
        
    }

    public function index()
    {
        $data=DataModel::select('data_id','score','help_num','bank_num','match.match_id','match.start_time','tA.team_name as tA_name','tB.team_name as tB_name','player_name')
        ->join('player','data.player_id','=','player.player_id')
        ->join('match','data.match_id','=','match.match_id')
        ->join('team as tA','match.team_one',"=",'tA.team_id')
        ->join('team as tB','match.team_two',"=",'tB.team_id')
        ->paginate(2);
        // var_dump($data);exit;
        return view('admin/data/index',['data'=>$data]);
    }
}
