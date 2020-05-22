<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct()
    {
        // 绑定中间件
        //$this->middleware('checklogin');
    }

    // 登录显示
    public function index()
    {
        return view('login.index');
    }

    // 登录处理
    public function login(Request $request)
    {
        // 表单验证
        $data = $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
            #'code' => 'required|captcha'
        ]);
        unset($data['code']);
        $model = User::where($data)->first();

        if (!$model) {
            echo "<script>alert('登录失败')</script>";
            return view('login.index');
        }
        $username=$data['username'];
        $redis = new \Redis;
        $ret = $redis->connect("127.0.0.1", 6379, 3);
        // dump(get_class_methods($redis));exit;
        // dump($redis->get('login'));exit;
        if ($redis->get($username) > 3) {
            echo "<script language=\"JavaScript\">\r\n";
            echo " alert(\"登录超过十次\");\r\n";
            echo "</script>";
            return view('login.index');
        } else {
            if ($redis->get($username) == null) {
                $redis->set($username, 0);
            } else {
                $redis->incr($username);
                if ($redis->get($username) > 3) {
                    $time = mktime(23, 59, 59, date('m'), date('d'), date('Y'));
                    $redis->expire($username, $time);
                    echo "<script language=\"JavaScript\">\r\n";
                    echo " alert(\"登录超过三次\");\r\n";
                    echo "</script>";
                    return view('login.index');
                }
            }
        }


        // 写session
        session(['user'=> $model]);
        // with 设置闪存
        return redirect(route('user.index'))->with('success', '登录成功');
    }
}
