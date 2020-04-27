<?php

namespace app\admin\controller;

use think\Controller;

class LoginController extends Controller {
    public function index() {
        return $this->fetch();
    }
    public function login() {
//        $username = input('username');
//        $password = input('password');
        $data=input();
//        var_dump($data['username']);exit;
        $rule=[
            'username|用户名'=>'require|max:10|min:5',
            'password|密码'=>'require'
        ];
        $res = $this->validate($data,$rule);
        if($res !== true){
            $this -> error($res);exit;
        }

        $name=$data['username'];
        $password=$data['password'];

        $loginKey = 'user:' . $name;
        $redis = new \Redis();
        $redis->connect('123.56.53.80', 6379, 10);
        $redis->auth('madamada');


        if (!$redis->exists($loginKey)) {
            return $this->error('登录失败');
        }

        $nums = $redis->get($name);

        if($nums > 2){
            //超过错误次数
            return $this->error('登录失败次数过多，请60s后重试');
        }else{
            //没有超过错误次数
            //验证密码
           $truePwd =  $redis->get($loginKey);//查询数据库
            if($password == $truePwd){
                $redis->del($name);
                session('admin.user',$data['username']);
                return $this->success('登录成功', url('admin/news/index'));
            }else{
                $redis->incr($name);
                return $this->error('登录失败,用户名或密码错误错误次数为'.$redis->get($name).'次');
//                echo '用户名或密码错误错误次数为'.$redis->get($name).'次';
                //设置过期时间
                $redis->EXPIRE($name, 60);
//                return $this->error('登录失败次数过多，请60s后重试');
//                $redis->setTimeout($name,60);
            }
        }

//        $pwd = $redis->get($loginKey);
//        if ($pwd != $data['password']) {
//            return $this->error('登录失败');
//        }



//        session('admin.user',$data['username']);
//        return $this->success('登录成功', url('admin/news/index'));
    }
}
