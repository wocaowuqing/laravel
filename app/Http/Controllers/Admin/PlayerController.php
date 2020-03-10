<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\TeamModel;
use App\Model\PlayerModel;
class PlayerController extends Controller
{
    public function add($id='')
    {
        $where=[
            'team_id'=>$id
        ];
        $teamInfo=TeamModel::where($where)->get();
        return view('admin/player/add',['teamInfo'=>$teamInfo]);
    }

    public function create()
    {
        $data=request()->all();
        $res=PlayerModel::create($data);
        if($res==true){
            echo "<script>alert('添加成功');location.href='http://ww.wen5211314.com/player/index'</script>";
        }
    }

    public function index()
    {
       
        $playerInfo=PlayerModel::join('team','player.team_id','=','team.team_id')->paginate(4);
        return view('admin/player/index',['playerInfo'=>$playerInfo]);
    }
}
