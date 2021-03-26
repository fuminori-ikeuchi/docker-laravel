<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * モデルと関連しているテーブル
     *
     * @var string
     */
    protected $table = 'orders';  // ordersテーブルを使う
    protected $fillable = ['name', 'o_num'];

    public function stock() // 単数形
    {
        return $this->belongsTo(Stock::class);
    }

    public static function getOrders()
    {
        return self::all();     // コントローラでgetStocks()を呼び出して、returenで取得した値をコントローラに返している
    }

    public static function registerOrder($create)
    {
        return self::create($create);
    }

    public static function updateOrder($record, $update)
    {
        self::where('id', $record)->update($update);      // where('id', $record)の'id'はカラム、おぶじぇくと(配列か)
    }

    public static function getStatus($o_id)
    {
        return self::find($o_id);  // self::create...自らのテーブルから受け取ったidを取得しreturnする
    }
    
    public static function change_status($o_id, $update)
    {
        self::where('id', $o_id)->update($update);
        
    }

}
