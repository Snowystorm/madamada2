<?php

namespace app\admin\controller;


class NewsController extends BaseController
{
    public function  index(){
        $data=[];
	$this->_redis->select(1);
        $ids=$this->_redis->zrange('news:zset:id',0,-1);
        foreach ($ids as $id){
            $key='news:id:'.$id;
            $item=$this->_redis->hgetall($key);
            $data[]=$item;
        }
        return view('',compact('data'));
    }
    public function create(){
        return view('');
    }
    public function store(){
        $data=input('post.');
//        dump($data);exit;

        $rule=[
            'title|标题'=>'require',
            'describle|描述'=>'require',
            'author|作者'=>'require',
            'body|内容'=>'require'
        ];
        $res = $this->validate($data,$rule);
        if($res !== true){
            $this -> error($res);exit;
        }


	$this->_redis->select(1);
        $idKey='news:id';
        $id=$this->_redis->incr($idKey);
        $hkey='news:id:'.$id;
        $data['id']=$id;

        $this->_redis->hMset($hkey,$data);

        $zkey='news:zset:id';
        $this->_redis->zAdd($zkey,$id,$id);

        return $this->success('添加成功！','index');
    }
    public function  del(){
        $id=input('id');
//        dump($id);exit;
	$this->_redis->select(1);
        $hKey='news:id:'.$id;
        $this->_redis->del($hKey);
        $zKey='news:zset:id';
        $this->_redis->zrem($zKey,$id);
        return ['status'=>0,'msg'=>'删除成功！'];
    }
    public function  edit(){
        $id=input('id');

//        dump($data);exit;
	$this->_redis->select(1);
        $hKey='news:id:'.$id;
        $item=$this->_redis->hgetall($hKey);
//        dump($item);
        return view('',compact('item'));
    }
    public function  update(){
        $data=input();

        $rule=[
            'title|标题'=>'require',
            'describle|描述'=>'require',
            'author|作者'=>'require',
            'body|内容'=>'require'
        ];
        $res = $this->validate($data,$rule);
        if($res !== true){
            $this -> error($res);exit;
        }


//        dump($data);exit;
        $id=$data['id'];
	$this->_redis->select(1);
//        $title=$data['title'];
//        $body=$data['body'];
//        $author=$data['author'];
//        $describle=$data['describle'];
        $hKey='news:id:'.$id;
        if(!$this->_redis->hmset($hKey,$data)){
            $this->error('修改失败！','index');
        }else{
            $this->success('修改成功！','index');
        }
    }
    public function delAll(){
	$this->_redis->select(1);
        $this->_redis->flushdb();
        $this->success('全部删除成功！','index');
    }

    public function logout()
    {
        session(null);
        $this->success('退出成功！', 'admin/login/index');
    }
}
