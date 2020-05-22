<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            // 定义表字段的名称和字段类型
            // int类型的主键id字段 无符号，自增长
            $table->increments('id');
            // 账号
            $table->string('username',50)->unique()->comment('账号');
            // 密码
            $table->string('password',255)->comment('密码');
            $table->string('pic',255)->default('')->comment('用户头像');
            // 性别
            $table->enum('sex',['男','女'])->default('男')->comment('性别');
            // 描述
            $table->string('desn',1000)->nullable()->comment('描述');
            // 软删除
            $table->softDeletes();
            // 加入 created_at 和 updated_at 两个日期字段
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
