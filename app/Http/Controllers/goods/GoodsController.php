<?php

namespace App\Http\Controllers\goods;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\MatchModel;
class GoodsController extends Controller
{
    public function index()
    {
        return view('good/index');
    }
    public function match_msg(Request $request){
        $match_id=$request->match_id;
        $data=MatchModel::where('match_id',$match_id)->get()->toArray();
        echo json_encode(['code'=>1,'data'=>$data]);
    }
    public function detail(Request $request){
        $data=$request->input();
        return view('good.detail',['data'=>$data]);
    }
    public function create_user_msg(Request $request){
        $data=$request->input();
        $res=WordModel::create($data);
        if ($res) {
            echo json_encode(['code'=>1]);
        }
    }
    public function login()
    {
        
        return view('good/login');
    }
    public function login_do(Request $request)
    {
        $result=$request->all();//only
        dd($result);
        $phone=$result['telphone'];//取手机号
        $code=rand(111111,666666);//随机数
        Session::put('jiushen',$code);//设置了一个jiushen对应的值   Session::get('jiushen');
        $url='http://api.sms.cn/sms/?ac=send&uid=账号&pwd=加密密码&template=模板id&mobile='.$phone.'&content={"code":"'.$code.'"}';
        //file_get_contents  读取文件信息
        //file_put_contents  写入文件
        // file_put_contents('demo.txt', $url);
        $info=file_get_contents($url);//json
        //如何将json数据转换成数组  json_decode($info)   对象   json_decode($info,true)  数组
        $data=json_decode($info,true);
        if($data['stat']==100){
            $array['status']=100;
            $array['info']="短信发送成功";
        }else{
            file_put_contents('demo.txt', $url);
            $array['status']=101;
            $array['info']="短信发送失败";
        }
        return $status;
    }
}
