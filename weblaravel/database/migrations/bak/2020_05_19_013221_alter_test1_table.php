<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTest1Table extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        // 修改数据
        Schema::table('test1', function (Blueprint $table) {
            // 密码
            $table->string('password',255)->comment('密码');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('test1', function (Blueprint $table) {
            // 删除字段  migrate:rollback 对应我们的版本号的时就会触发
            $table->dropColumn('sex');
        });
    }
}
