<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extusers', function (Blueprint $table) {
            $table->increments('id');
            // 外键
            $table->unsignedInteger('user_id')->default(0)->comment('用户主表ID');
            $table->string('intro',1000)->default('')->comment('简介');
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
        Schema::dropIfExists('extusers');
    }
}
