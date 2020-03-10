<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\MatchModel;
use App\Model\TeamModel;
class MatchController extends Controller
{
    public function add()
    {
        $teamInfo=TeamModel::get();
        return view('admin/match/add',['teamInfo'=>$teamInfo]);
    }

    public function create()
    {
        $data=request()->all();
        // print_r($data);exit;
        $data['start_time']=strtotime($data['start_time']);
        $data['end_time']=strtotime($data['end_time']);
        $res=MatchModel::create($data);
        if($res){
            echo "<script>alert('添加成功');location.href='http://ww.wen5211314.com/match/index'</script>";
        }
    }

    public function index()
    {   
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
                                ->paginate(3);
                                // dd($matchInfo);
        return view('admin/match/index',['matchInfo'=>$matchInfo]);
    }
}
