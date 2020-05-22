<?php

use Illuminate\Database\Seeder;

use App\Models\User;

class TestSeeder extends Seeder {
    /**
     * 填充代码所用的位置
     */
    public function run() {
        // 清空
        User::truncate();
        #DB::table('test')->truncate();
        #$data = [];
        for ($i = 1; $i <= 20; $i++) {
            $data = [
                'username' => 'user_' . $i,
                'password' => 'pwd_' . $i,
                'sex' => ['男', '女'][rand(0, 1)],
                'desn' => 'desn_' . $i
            ];
            User::create($data);
        }
        User::where('id',1)->update(['username'=>'admin','password'=>'admin888']);
        #DB::table('test')->insert($data);
    }
}
