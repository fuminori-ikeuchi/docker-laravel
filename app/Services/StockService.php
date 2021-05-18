<?php

namespace App\Services;

use App\Http\Controllers\Home\HomeController;              // ホームコントローラに干渉
use App\Models\Stock;                                      // モデルに干渉
use Illuminate\Database\Eloquent\Collection;               // csv出力のため
use Log;                                                   // デバッグ
use Symfony\Component\HttpFoundation\StreamedResponse;     // csv出力のため

class StockService
{
    public function getStocks()                                 // ストック一覧(index)
    {
        return Stock::getStocks();                              // StockモデルのgetStocks()を呼び出し
        // Log::info('インスタンス化完了');
        // Log::debug(print_r($aaa, true));                     // 確認済み(モデルからの引き渡し)
    }

    public function getCheck($s_id)                             // show画面(find)
    {
        // Log::debug($s_id);
        return Stock::getCheck($s_id);                          // StockモデルのgetCheck($s_id)を呼び出し
    }

    public function registerStock($create)                     // 登録作業
    {
        // $test = $request->all();
        // Log::debug(print_r($test, true));
        Stock::registerStock($create);                         // StockモデルのgetCheck($s_id)を呼び出し
    }

    public function download($request)                                 // csvについて
    {
        $record = Stock::getAll();                               // 1、表示させたいものを全部モデルからとってくる(サービス経由)
        // $cvsList = [];
        $cvsList[] = ["id", "在庫", "在庫数", "金額/単価", "登録日"];   // 2、csv出力時のheaderになる部分を先に配列に入れる
        foreach ($record as $records) {                             // 3-1、１でとってきた全てをforeachにかける
            $cvsList[] = [                                          // 4、2の配列に順番に入れていく
                // デバッグ(3-2)
                $records->id,
                $records->name,
                $records->num,
                $records->price,
                $records->created_at,
            ];
            // Log::debug(print_r($records->name, true));   // 3−2、foreachの中でデバッグ（値がとれているか）
        }
        // Log::debug(print_r($cvsList, true));

        $response = new StreamedResponse(function () use ($request, $cvsList) {
            $stream = fopen('php://output', 'w');

            //　文字化け回避
            stream_filter_prepend($stream, 'convert.iconv.utf-8/cp932//TRANSLIT');

            // CSVデータ
            foreach ($cvsList as $key => $value) {
                fputcsv($stream, $value);
            }
            fclose($stream);
        });
        $response->headers->set('Content-Type', 'application/octet-stream');
        $response->headers->set('Content-Disposition', 'attachment; filename="sample.csv"');
        return $response;
    }
}
