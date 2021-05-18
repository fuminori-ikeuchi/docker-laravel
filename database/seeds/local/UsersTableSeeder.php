<?php

namespace Database\Seeds\Local;

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
                'password_confirm' => Hash::make('test0123'),
                'role'     => '1'
            ],
            [
                'id'       => 2,
                'name'     => 'にしむら',
                'email'    => 'nishi@icloud.com',
                'password' => Hash::make('12345678'),        // hashはパスワードを暗号化
                'password_confirm' => Hash::make('12345678'),
                'role'     => '2'
            ],
            [
                'id'       => 3,
                'name'     => 'さとう',
                'email'    => 'sato@icloud.com',
                'password' => Hash::make('11111111'),        // hashはパスワードを暗号化
                'password_confirm' => Hash::make('11111111'),
                'role'     => '3'
            ],
        ]);
    }
}
