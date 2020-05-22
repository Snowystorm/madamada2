<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// trait从php5.4之后就添加的新特性，php之前没有多继承，引入些特性后，php有点了类似于多继承
use Illuminate\Database\Eloquent\SoftDeletes;

// 此模型就和数据库中的web_users表对应，表就是模型，模型就是表
class User extends Model {
    // 继承过来
    use SoftDeletes;

    // 指定软删除标识字段
    protected $dates = ['deleted_at'];

    // 默认是模型的复数形式，可以定义表名  不需要指定表前缀
    #protected $table = 'user';

    // 默认主键名称为id,修改指定的id
    protected $primaryKey = 'id';

    // 时间管理 对于此2个字段的控制  created_at 和 updated_at
    // false就是不让模型管理（表字段中没有对应2个字段）  默认为true 模型管理时间字段
    // create方法添加才会管理时间，insert不会
    #public $timestamps = false;

    // 排除添加入库的字段(黑名单)  和  允许添加入库字段(白名单)
    // 用于后期使用 添加方法 create
    // 黑名单，表示可以添加所有的字段入库
    #protected $guarded = [];
    // 不允许username字段添加入库
    #protected $guarded = ['username'];

    // 白名单
    // 允许添加入库的字段
    #protected $fillable = ['id','username'];

    // 设置黑名单
    protected $guarded = [];

    // 一对一关系
    public function extData() {
        #return $this->hasOne(Extuser::class,'user_id','id');
        //        // 本模型主键名称为id
        #return $this->hasOne(Extuser::class,'user_id');
        // 外键名称，一定是 模型类型_id 组合
        return $this->hasOne(Extuser::class);
    }

    // 一对多
    public function arts() {
        return $this->hasMany(Art::class);
    }

    // 多对多
    public function auths() {
        return $this->belongsToMany(Auth::class,'user_auth','user_id','auth_id');
    }


}
