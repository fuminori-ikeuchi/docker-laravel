<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Log;
use Illuminate\Database\Eloquent\Collection;

class Stock extends Model
{
    /**
     * モデルと関連しているテーブル
     *
     * @var string
     */
    protected $table = 'stocks';                   // stocksテーブルを使う
    protected $fillable = ['name', 'price'];       // 新規登録でnameとpriceカラムに入れるのを許可

    public function orders() // 複数形
    {
        return $this->hasMany(Order::class);       // 紐付け、１対多
    }

    // public function user() // 単数形
    // {
    //     return $this->belongsTo(User::class);
    // }

    public static function getStocks()                  // 在庫の全ての情報をレコードにして返す, ページネーション（15）
    {
        return self::paginate(15);                             // サービスでgetStocks()を呼び出して、returenで取得した値をサービスに返している
    }

    public static function registerStock($create)
    {
        self::create($create);                          // self::create() ... 自らのdbに保存、保存だけのためreturnいらず
    }

    public static function getCheck($s_id)   // showページ
    {
        return self::find($s_id);                       // self::find()...自らのdbからfindの引数で検索し、取得したレコード（一つ）をreturnする
    }

    public static function recordCheck($name)
    {
        return self::firstwhere('name', $name);         // orderでnameをとり、stockモデルでname検索。nameで引っかかったレコードをHomeコントローラに返す
        // Log::debug($aaa->name);
    }

    public static function getChecker($checker)
    {
        return self::firstwhere('name', $checker);
    }

    public static function totalNum($id, $update)
    {
        self::where('id', $id)->update($update);    // 'name'でも'id'でも可でサービスで取得できた方に合わせる。すでにindexで表示しているためreturnいらない
    }

    public static function getAll()                  // 在庫の全ての情報をレコードにして返す, csv
    {
        return self::all();                             // サービスでgetAll()を呼び出して、returenで取得した値をサービスに返している
    }
}
