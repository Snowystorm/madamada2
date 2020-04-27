<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function api(array $data, int $httpCode = 200){
    return json([
        'status'=>0,
        'msg'=>'成功！',
        'data'=>$data
    ],$httpCode,[
        'Access-Control-Allow-Origin'=>'*',
        'Access-Control-Allow-Methods'=>'GET,POST,PATCH,PUT,DELETE',
        'Access-Control-Allow-Headers'=>'Authorization, Content-Type, If-Match, If-Modified-Since, If-None-Match, If-Unmodified-Since, X-Requested-With',
    ]);
}