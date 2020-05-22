<?php

namespace App\Http\Controllers;

use App\Models\Extuser;
use App\Models\User;
use Illuminate\Http\Request;
use Predis\Client;

class DemoController extends Controller
{
    // 一对一
    public function hasone()
    {

        // 查询主表
        /*$data = User::find(1);
        dump($data->toArray());
        dump($data->extData()->first()->toArray());*/

        /*$data = User::find(1);
        dump($data->toArray());
        dump($data->extData->toArray());*/

        // 预加载
        /*$data = User::with('extData')->find(1);
        dump($data->toArray());*/

        // 指定关联模型表中的字段
        #$data = User::with('extData:user_id,intro')->find(1);

        // 查看当前用户id=1的信息和对应关联文章
        /*$data = User::find(1);
        dump($data->toArray());
        dump($data->arts()->get()->toArray());*/

        /*$data = User::find(1);
        dump($data->toArray());
        dump($data->arts->toArray());*/

        /*$data = User::with('arts')->find(1);
        dump($data->toArray());*/

        // 查id=1的用户并指查询id>=2的文章
        /*$data = User::with(['arts' => function ($query) {
            $query->where('id', '>=', 2);
        }])->find(1);
        dump($data->toArray());*/


        /*$data = User::with('auths')->find(1);
        dump($data->toArray());*/

        /*$userModel = User::find(1);
        dump($userModel->auths()->pluck('aname','id')->toArray());*/

        // 使用缓存
        // 判断是否有缓存
        #dump(cache()->has('userData'));
        /*if(cache()->has('userData')){
            // 获取缓存数据
            $data = cache('userData');
        }else{
            $data = User::with('auths')->find(1);
            // 设置缓存  [key=>value]    有效期 分钟
            cache(['userData' => $data], 5);
        }
        dump($data->toArray());*/

        // 删除缓存
        #cache()->forget('userData');
        // 清空所有的缓存，项目中有很多缓存，都给清空了   项目中不要出现
        #cache()->flush();

        // 先获取缓存中的userData中的key是否有值，有则获取，没有则执行匿名函数获取数据并设置到缓存中
        // $redis = new \Redis;
        // $ret = $redis->connect("127.0.0.1", 6379);
        // $data = cache()->remember('userData', 5, function () {
        //     return User::with('auths')->find(1);
        // });
        // dump($data->toArray());

        // $client = new Client();
        // $client->set('aa', 1111);
    }
}
