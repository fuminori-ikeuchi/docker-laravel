<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
            [
                'id'       => 1,
                'name'  => "ティッシュペーパー",
                'o_num'  => 100,
                'o_price'     => 100000,
                'deleted_at' => null,
                'stock_id' => 1,
                'status' => '発注確認'
            ],
            [
                'id'       => 2,
                'name'  => "コンドーム0.01",
                'o_num'  => 100,
                'o_price'     => 100000,
                'deleted_at' => null,
                'stock_id' => 2,
                'status' => '発注確認'
            ],
            [
                'id'       => 3,
                'name'  => "TENGA",
                'o_num'  => 100,
                'o_price'     => 80000,
                'deleted_at' => null,
                'stock_id' => 3,
                'status' => '発注確認'
            ],
            [
                'id'       => 4,
                'name'  => "ハサミ",
                'o_num'  => 100,
                'o_price'     => 10000,
                'deleted_at' => null,
                'stock_id' => 4,
                'status' => '発注確認'
            ],
            [
                'id'       => 5,
                'name'  => "のり",
                'o_num'  => 100,
                'o_price'     => 2000000,
                'deleted_at' => null,
                'stock_id' => 5,
                'status' => '発注確認'
            ],
            [
                'id'       => 6,
                'name'  => "飲むシリカ500ml",
                'o_num'  => 100,
                'o_price'     => 15000,
                'deleted_at' => null,
                'stock_id' => 6,
                'status' => '発注確認'
            ],
        ]);
    }
}
