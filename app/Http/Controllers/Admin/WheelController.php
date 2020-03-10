<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\WheelModel;
class WheelController extends Controller
{
    public function add(){
        return view('admin/wheel/add');
    }
    /**
     *  执行添加
     */
    public function create(){
        $wheel_name=request()->wheel_name;
        $is_show=request()->is_show;
        $wheel_img=request()->file('wheel_img');
        // dd($wheel_img);
        $ext=$wheel_img->getClientOriginalExtension();//获取文件后缀名
        $filename=md5(uniqid()).'.'.$ext;//生成随机文件名，拼接后缀
        $img=request()->wheel_img->storeAs("image",$filename);//
        // echo $img;exit;
        $res=WheelModel::create([
            "wheel_name"=>$wheel_name,
            "wheel_img"=>$img,
            "is_show"=>$is_show
        ]);
        if($res==true){
            echo "<script>alert('添加成功');location.href='http://ww.wen5211314.com/wheel/index'</script>";
        }
    }

    /**
     *  轮播图列表
     */
    public function index(){
        $data=WheelModel::paginate(4);
        // dd($data);
        return view('admin/wheel/index',['data'=>$data]);
    }

    /**
     *  即点即改
     */
    public function upd()
    {
        $data=request()->all();
       
        $where=[
            'wheel_id'=>$data['wheel_id']
        ];
  
        $data=[$data['field']=>$data['is_show']];
        $res=WheelModel::where($where)->update($data);
        if($res){
            $arr=['font'=>'成功','code'=>1];
            echo json_encode($arr);
        }else{
            $arr=['font'=>'失败','code'=>2];
            echo json_encode($arr);
        }
    }



   
}
