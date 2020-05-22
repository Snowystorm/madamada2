<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * 用于数据填充时的方法调用
     */
    public function run() {
        // 填充文件调用
        $this->call(TestSeeder::class);





    }
}
