<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\TeamModel;
class TeamController extends Controller
{
    /**
     * 球队添加
     */
    public function add()
    {
        return view('admin/team/add');
    }

    public function create()
    {
        $data=request()->all();
        $res=TeamModel::create($data);
        if($res){
            echo "<script>alert('添加成功');location.href='http://ww.wen5211314.com/team/index'</script>";
        }
    }

    public function index()
    {
        $teamInfo=TeamModel::paginate(4);
        return view('admin/team/index',['teamInfo'=>$teamInfo]);
    }
}
