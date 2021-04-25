<?php

namespace App\Services;

use App\Http\Controllers\Home\HomeController;
use App\Models\Stock;
use App\Models\Order;
use Log;

class OrderService
{
    public function getOrders()                                // オーダー一覧(index)
    {
        return Order::getOrders();                             // OrderモデルのgetOrders()を呼び出し
    }

    public function create($create)                            // オーダー登録作業(create, update)
    {
        // $test = $request->all();
        // Log::debug(print_r($test, true));
        $record = Order::registerOrder($create);               // 登録したものをモデルからサービスにreturnする（レコードで返される）
        // Log::debug($record->o_num);                         // 登録された名前をとれるかのdebug
        $name = $record->name;                                 // 登録された名前を変数に代入
        $stock_record = Stock::recordCheck($name);             // stockモデルでname検索し、ヒットしたレコード取得
        // Log::debug($stock_record->price);                   // stockモデルでname検索したレコードのprice, idが取得できるかの確認
        $update = [                                            // 先ほどnullありでデータベースに登録したレコードにstockモデルからとってきた情報でupdate
            "stock_id"   =>    $stock_record->id,
            "o_price"    =>    $stock_record->price * $record->o_num         // 1個あたりの金額(stockより) ＊ 発注個数(上記、$recordの個数'o_num')で発注金額
        ];
        Order::updateOrder($name, $update);                    // updateする($name, $update)の左辺がどこにするかの引数。（$nameは、$record->idでもなんでもok）右辺が何を渡すか
    }

    public function getStatus($o_id)
    {
        return Order::getStatus($o_id);                        // nameの情報がviewで必要。 Order::（モデルの）getStatus()（関数）を使用
    }

    public function changeStatus($o_id, $update)              // Requestはリクエストデータ、$requestはRequestを$requestとする
    {
        Order::changeStatus($o_id, $update);                        // 第一引数（whereのためのid）がどの、第二引数がなにを, updateのため$checkerの代わりにならず
        $checker = Order::check($o_id);                              // 変更したステータスのレコード(オーダー),id検索
        // Log::debug($checker->o_num);
        $o_num = $checker->o_num;                                    // if文の中の在庫数更新に使う発注個数を$o_numに代入
        if ($checker["status"] == "発注受取済み") {                    // $o_idでとってきたレコードのステータスでif文
            $num = Stock::getChecker($checker->name);                // 名前検索したレコードを "stockテーブル" から取得し変数へ代入
            $s_num = $num->num;                                      // 在庫数(stock)を変数に入れる
            $update = [
                "num"     =>    $o_num + $s_num                      // 発注個数と在庫数を足して配列に
            ];
            Stock::totalNum($num->id, $update);                // updateする($num->id, $update)の左辺がどこにするかの引数。($checker->nameでも可)右辺が何を渡すか
        }
    }
}
