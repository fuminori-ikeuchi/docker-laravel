<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;    // 緑色のものはuseの記述が必要

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id'       => 1,
                'name'     => 'ふみ',
                'email'    => 'fuminori.7127.lv19@icloud.com',
                'password' => Hash::make('test0123'),        // hashはパスワードを暗号化
                'role'     => '1'
            ]
        ]);
    }
}
