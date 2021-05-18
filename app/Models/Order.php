<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Log;
use Illuminate\Database\Eloquent\Collection;

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
        return $this->belongsTo(Stock::class);     // stockモデルに紐付け（１）
    }

    // public function user() // 単数形
    // {
    //     return $this->belongsTo(User::class);
    // }

    public static function getOrders()
    {
        return self::paginate(15);     // サービスでgetOrders()を呼び出して、returenで取得した値（レコード）をサービスに返している
    }

    public static function registerOrder($create)
    {
        return self::create($create);                      // 穴あきで"名前"と"発注個数"を登録し、updateで使うためreturnで返す
    }

    public static function updateOrder($record, $update)   // 先ほど保存したレコードをname検索し、ヒットしたところにupdateかける
    {
        self::where('id', $record)->update($update);     // where('id', $record)の'id'はカラム、おぶじぇくと(配列か) 'id'
    }

    public static function getStatus($o_id)
    {
        return self::find($o_id);                          // self::find()...自らのdbからfindの引数で検索し、取得したレコード（一つ）をreturnする
    }

    public static function changeStatus($o_id, $update)
    {
        self::where('id', $o_id)->update($update);         // idでヒットしたレコードにupdate
    }

    public static function check($o_id)
    {
        return self::firstwhere('id', $o_id);             // 初めにヒットしたidのレコードを返す
    }
}
