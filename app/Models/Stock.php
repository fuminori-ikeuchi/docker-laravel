<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    /**
     * モデルと関連しているテーブル
     *
     * @var string
     */
    protected $table = 'stocks';  // stocksテーブルを使う
    protected $fillable = ['name', 'price'];  // 新規登録でnameとpriceカラムに入れるのを許可

    public static function getStocks()
    {
        return self::all();     // コントローラでgetStocks()を呼び出して、returenで取得した値をコントローラに返している
    }

    public static function registerStock($create)
    {
        self::create($create);  // self::create...自らのテーブルに保存
    }

    public static function getCheck($s_id)
    {
        return self::find($s_id);  // self::create...自らのテーブルから受け取ったidを取得しreturnする
    }
}
