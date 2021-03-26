<?php

namespace App\Http\Controllers\Home;   //このファイルはどの階層にあるか

use App\Http\Controllers\Controller;   // Controller経由のため
// use App\Stock; 最初に書かれていた(useは何を使うか)
use Illuminate\Http\Request;  // リクエストされたものを取得できるように
use App\Models\Stock;   // stockモデルを使う
use App\Models\Order;   // orderモデルを使う
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
            // 'stock'      => "ああああああああ"
            "stock"         => Stock::getStocks()
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function o_index()
    {
        $data = [
            // 'order'      => "ああああああああ"
            "order"         => Order::getOrders()   // Order::（モデルの）getOrders()（関数）を使用
        ];

        return view('order.index', $data);  // order/indexに、$dataをもたす
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function o_register()  // 在庫登録画面
    {
        $data = [
            // 'stock'      => "ああああああああ"
            "stock"         => Stock::getStocks()
        ];
        return view('order.register', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function o_create(Request $request)   // create(Request $request)のRequestはリクエストデータ、$requestはRequestを$requestとする
    {
        // $test = $request->all();               // 上記のリクエストの全てを$testに
        // Log::debug(print_r($test, true));      // Log::debug('デバッグメッセージ')に配列として引数$testを渡している
        $create = [
            'name'     =>      $request->input('name', null),
            'o_num'      =>      $request->input('o_num', null)
        ];
        $record = Order::registerOrder($create);   // 登録されたものをモデルからコントローラにreturnするとレコードで返される
        // Log::debug($record->name);
        
        $name = $record->name;

        $stock_record = Stock::recordCheck($name);
        // Log::debug($stock_record->price);

        $update =[
            'stock_id'  => $stock_record->id,
            'o_price'   => $stock_record->price * $request->input('o_num', null)
        ];

        Order::updateOrder($record->id, $update);      // updateするときにどこにするか($record->id, $update)の左辺がどこにするか、右辺が何を渡すか

        return redirect('/order');   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function status($o_id)
    {
        $data = [
            // 'stock'      => "ああああああああ"
            "order"         => Order::getStatus($o_id)   // Order::（モデルの）getCheck()（関数）を使用
        ];

        return view('order.status', $data);  // stock/indexに、$dataをもたす
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function change_status(Request $request)   // change_status(Request $request)のRequestはリクエストデータ、$requestはRequestを$requestとする
    {
        $o_id = $request["id"];               // 上記のリクエストのidを$o_idに
        // Log::debug($test);      // Log::debug('デバッグメッセージ')に配列として引数$testを渡している
        $update = [
            'status'     =>      $request->input('status', null),
        ];
        Order::change_status($o_id, $update);
        return redirect('/order');
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

