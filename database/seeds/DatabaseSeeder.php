<?php

use Illuminate\Database\Seeder;
use Database\Seeds\Local;

class DatabaseSeeder extends Seeder
{


    const LOCAL = [
        Local\UsersTableSeeder::class,                                  // constに追加していく
        Local\StocksTableSeeder::class,
        // Local\StocksTableSeeder::class,                              // 使用していない為、コメントアウト
    ];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            $this->call(App::isLocal() ? self::LOCAL : self::PROD);
        });

        // $this->call(StocksTableSeeder::class);                         // localを入れるまで使用
        // $this->call(UsersTableSeeder::class);
        // $this->call(OrdersTableSeeder::class);
        // factory(App\Models\Stock::class, 5)->create();                 ストック
    }
}
