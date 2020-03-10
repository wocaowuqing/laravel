<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\WheelModel;
class IndexController extends Controller
{
    public function index()
    {
        $data=WheelModel::get();
        // var_dump($data);exit;
        return view('index/index/index',['data'=>$data]);
    }
}
