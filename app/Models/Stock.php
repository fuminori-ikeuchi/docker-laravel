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

    public function orders() // 複数形
    {
        return $this->hasMany(Order::class);     // 紐付け、１対多
    }

    
    // public function user() // 単数形
    // {
    //     return $this->belongsTo(User::class);
    // }

    public static function getStocks()     // 在庫の全ての情報をレコードにして返す
    {
        return self::all();     // コントローラでgetStocks()を呼び出して、returenで取得した値をコントローラに返している
    }

    public static function registerStock($create)
    {
        self::create($create);  // self::create() ... 自らのテーブルに保存、保存だけのためreturnいらず
    }

    public static function getCheck($s_id)  // showページ
    {
        return self::find($s_id);  // self::create...自らのテーブルから受け取ったidを取得しreturnする
    }
    
    public static function recordCheck($name)
    {
        return self::firstwhere('name', $name);       // orderでnameをとり、stockモデルでname検索。nameで引っかかったレコードをHomeコントローラに返す
    }

    
    public static function getChecker($checker)
    {
        return self::firstwhere('name', $checker);
    }

    
    public static function totalNum($getName, $update)
    {
        self::where('name', $getName)->update($update);    // 'name'でも'idでも'可でコントローラに合わせる。すでにindexで表示しているためreturnいらない
    }
}
