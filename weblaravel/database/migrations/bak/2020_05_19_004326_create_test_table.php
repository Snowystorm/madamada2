<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestTable extends Migration {
    /**
     * 生成数据表的方法
     * 数据迁称，生成的表字段，默认都为非空 not null
     */
    public function up() {
        //           数据表表名不在加前缀，创建成功时会自动添加对应的前缀  真正的表名web_test
        Schema::create('test', function (Blueprint $table) {
            // 定义表字段的名称和字段类型
            // int类型的主键id字段 无符号，自增长
            $table->increments('id');
            // 账号
            $table->string('username',50)->unique()->comment('账号');
            // 密码
            $table->string('password',255)->comment('密码');
            // 性别
            $table->enum('sex',['男','女'])->default('男')->comment('性别');
            // 描述
            $table->string('desn',1000)->nullable()->comment('描述');
            // 加入 created_at 和 updated_at 两个日期字段
            $table->timestamps();
        });
    }

    /**
     * 回滚数据迁移执行的方法 (删除表)
     */
    public function down() {
        // 删除表
        Schema::dropIfExists('test');
    }
}
