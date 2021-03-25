<?php

namespace App\Http\Controllers\Home;   //このファイルはどの階層にあるか

use App\Http\Controllers\Controller;   // Controller経由のため
// use App\Stock; 最初に書かれていた(useは何を使うか)
use Illuminate\Http\Request;  // リクエストされたものを取得できるように
use App\Models\Stock;   // stockモデルを使う
use Log;  // デバッグのため

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            // 'stock'      => "ああああああああ"
            "stock"         => Stock::getStocks()   // Stock::（モデルの）getStocks()（関数）を使用
        ];

        return view('stock.index', $data);  // stock/indexに、$dataをもたす
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function check($s_id)
    {
        $data = [
            // 'stock'      => "ああああああああ"
            "stock"         => Stock::getCheck($s_id)   // Stock::（モデルの）getCheck()（関数）を使用
        ];

        return view('stock.check', $data);  // stock/indexに、$dataをもたす
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()  // 在庫登録画面
    {
        $data = [
            'stock'      => "ああああああああ"
            // "stock"         => Stock::getStocks()
        ];
        return view('stock.register', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)   // create(Request $request)のRequestはリクエストデータ、$requestはRequestを$requestとする
    {
        $test = $request->all();               // 上記のリクエストの全てを$testに
        Log::debug(print_r($test, true));      // Log::debug('デバッグメッセージ')に配列として引数$testを渡している
        $create = [
            'name'     =>      $request->input('name', null),
            'price'    =>      $request->input('price', null)
        ];
        Stock::registerStock($create);
        return redirect('/');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        //
    }
}

