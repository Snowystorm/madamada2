<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 权限表
        Schema::create('auths', function (Blueprint $table) {
            $table->increments('id');
            $table->string('aname',50)->default(0);
            $table->timestamps();
        });
        // 用户与权限中间表
        Schema::create('user_auth', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('auth_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auths');
        Schema::dropIfExists('user_auth');
    }
}
