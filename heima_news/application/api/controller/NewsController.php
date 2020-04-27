<?php

namespace app\api\controller;

use think\Controller;

class NewsController extends Controller
{
    protected $_redis = null;
    public function  _initialize()
    {
        $config_redis=config('redis');
        $this->_redis = new \Redis();
        $this->_redis->connect($config_redis['host'], $config_redis['port'], $config_redis['timeout']);
        $this->_redis->auth($config_redis['auth']);
	    $this->_redis->select(1);
    }
    public function  index(){
        $data=[];
	    $this->_redis->select(1);
        $ids=$this->_redis->zrange('news:zset:id',0,-1);
        foreach ($ids as $id){
            $key='news:id:'.$id;
            $item=$this->_redis->hgetall($key);
            $data[]=$item;
        }
        return api($data);
    }
    public function detail(int $id) {
        $key = 'news:id:' . $id;
        $data = $this->_redis->hgetall($key);
        return api($data);
    }
}
