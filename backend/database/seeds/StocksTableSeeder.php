<?php

use Illuminate\Database\Seeder;

class StocksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stocks')->insert([
            [
                'id'       => 1,
                'name'  => "ティッシュペーパー",
                // 'num'  => 1,
                'price'     => 1000,
                'deleted_at' => null
                // 'o_num' => null,
                // 'status' => '未発注'
            ],
            [
                'id'       => 2,
                'name'  => "コンドーム0.01",
                // 'num'  => 1,
                'price'     => 1000,
                'deleted_at' => null,
                // 'o_num' => null,
                // 'status' => '未発注'
            ],
            [
                'id'       => 3,
                'name'  => "TENGA",
                // 'num'  => 1,
                'price'     => 800,
                'deleted_at' => null,
                // 'o_num' => null,
                // 'status' => '未発注'
            ],
            [
                'id'       => 4,
                'name'  => "ハサミ",
                // 'num'  => 1,
                'price'     => 100,
                'deleted_at' => null,
                // 'o_num' => null,
                // 'status' => '未発注'
            ],
            [
                'id'       => 5,
                'name'  => "のり",
                // 'num'  => 1,
                'price'     => 20000,
                'deleted_at' => null,
                // 'o_num' => null,
                // 'status' => '未発注'
            ],
            [
                'id'       => 6,
                'name'  => "飲むシリカ500ml",
                // 'num'  => 1,
                'price'     => 150,
                'deleted_at' => null,
                // 'o_num' => null,
                // 'status' => '未発注'
            ],
            
        ]);
    }
}
