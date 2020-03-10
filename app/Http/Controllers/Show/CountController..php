<?php

namespace App\Http\Controllers\Show;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\MatchModel;
class CountController extends Controller
{
    public function count(Request $request)
    {
        // echo 111;
        $match_id = $request->id;
        // dd($match_id);
        $res = MatchModel::where('match_id',$match_id)->count();
        dd($res);
        if($res == 1){
            echo json_encode(['ret'=>1,'msg'=>'有']);die;
        }else{
            echo json_encode(['ret'=>2,'msg'=>'无']);die;
        }
    }

    public function countshow(Request $request)
    {
        return view('show/count/countshow');
    }
}