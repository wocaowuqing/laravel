<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AdminModel;

class AdminController extends Controller
{
    public function login()
    {
        return view('admin/login/login');
    }

    public function loginDo(Request $request)
    {
        //接收数据
        $data = $request->input();
        // var_dump($data);die;
        //单独获取name和pwd
        $name = $data['admin_name'];
        $pwd = $data['admin_pwd'];
        //密码加密
        $pwd1 = md5($data['admin_pwd']);
        // var_dump($pwd);
        //添加入库
        $res = AdminModel::create([
            'admin_name' => $data['admin_name'],
            'admin_pwd' => $pwd1,
        ]);
		if($res){
            // echo 111;die;
			echo "<script>alert('登录成功');location.href='http://ww.wen5211314.com/admin'</script>";
		}else{
			echo "<script>alert('你的用户和密码有误');location.href='http://ww.wen5211314.com/login'</script>";
		}
    }

}
