<?php

namespace App\Http\Controllers\Home;    //このファイルはどの階層にあるか

use App\Http\Controllers\Controller;    // Controller経由のため
// use App\Stock; 最初に書かれていた(useは何を使うか)
use Illuminate\Http\Request;            // リクエストされたものを取得できるように
use App\Models\Stock;                   // stockモデルを使う
use App\Models\Order;                   // orderモデルを使う
use Log;                                // デバッグのため

use App\Services\OrderService;          // orderサービス使用(ドメイン駆動)
use App\Services\StockService;          // stockサービス使用(ドメイン駆動)

use Symfony\Component\HttpFoundation\StreamedResponse;     // csv出力のため
use Illuminate\Database\Eloquent\Collection;

class HomeController extends Controller
{
    public function __construct(
        OrderService $orderService,
        StockService $stockService
        )     // ZaikoService(クラス)を$ZaikoServiceとする
    {
        $this->orderService = $orderService;                    // 上記の変数 $orderServiceを $this->orderService に代入
        $this->stockService = $stockService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()      //在庫一覧
    {
        $data = [
            "stock"     =>    $this->stockService->getStocks()   // Stock::(モデルの)getStocks()(関数)を使用 -->> zaikoService(上で定義済み)のgetStocks()に変更
        ];
        return view('stock.index', $data);  // stock/indexに、$dataをもたす。すべての在庫情報
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function check($s_id)     // show
    {
        $data = [
            "stock"    =>   $this->stockService->getCheck($s_id)   // Stock::（モデルの）getCheck()（関数）を使用 -->> zaikoService(上で定義済み)のgetCheck($s_id)
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
        return view('stock.register');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)   // create(Request $request)のRequestはリクエストデータ、$requestはRequestを$requestとする
    {
        // $test = $request->all();               // 上記のリクエストの全てを$testに
        // Log::debug(print_r($test, true));      // Log::debug('デバッグメッセージ')に配列として引数$testを渡している
        $this->stockService->registerStock($request);
        return redirect('/');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function o_index()   // 発注一覧
    {
        $data = [
            "order"         => $this->orderService->getOrders()   // Order::（モデルの）getOrders()（関数）を使用
        ];
        return view('order.index', $data);  // order/indexに、$dataを持たせてindexで使用
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function o_register()  // 発注登録画面
    {
        $data = [
            "stock"     =>   $this->stockService->getStocks()    // form のnameの情報を使っているため$dateを使用
        ];
        return view('order.register', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function o_create(Request $request)    // create(Request $request)のRequestはリクエストデータ、$requestはRequestを$requestとする
    {
        // $test = $request->all();               // 上記のリクエストの全て->all()を$testに
        // Log::debug(print_r($test, true));      // Log::debug('デバッグメッセージ')に配列として引数$testを渡している
        $create = [                                            // $createに入力されたデータを配列に代入
            'name'       =>      $request->name,
            'o_num'      =>      $request->input('o_num', null)
        ];
        $this->orderService->create($create);
        // $record = Order::registerOrder($create);     // 登録したものをモデルからコントローラにreturnする（レコードで返される）
        // $name = $record->name;                       // 登録された名前を変数に代入
        // $stock_record = Stock::recordCheck($name);   // stockモデルでname検索し、ヒットしたレコード取得
        // $update =[                                   // 先ほどnullありでデータベースに登録したレコードにstockモデルからとってきた情報でupdate
        //     'stock_id'  => $stock_record->id,        // stock の id(PK)を$stock_record->idでとってる
        //     'o_price'   => $stock_record->price * $request->input('o_num', null)   // 1個あたりの金額(stockより) ＊ 発注個数($requestの'o_num')で発注金額
        // ];
        // Order::updateOrder($record->name, $update);      // updateする($record->name, $update)の左辺がどこにするか（->nameは->idでもなんでもok）、右辺が何を渡すか
        return redirect('/order');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function status($o_id)                                         // 発注状態の変更ページ
    {
        $data = [
            "order"       =>      $this->orderService->getStatus($o_id)   // 名前を表示させる為、nameの情報必要。サービスのgetStatus()（関数）を使用
        ];
        return view('order.status', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function change_status(Request $request)   // change_status(Request $request)のRequestはリクエストデータ、$requestはRequestを$requestとする
    {
        $o_id = $request["id"];                       // 上記のリクエストのidを$o_idに。 ステータス変更先の検索のためにhidden(form)でおくったやつ
        // $test = $request->all();                   // 上記のリクエストの全て->all()を$testに
        // Log::debug(print_r($test, true));          // ステータス、idの取得
        $update = [
            'status'     =>      $request->status
        ];
        $this->orderService->change_status($o_id, $update);       // サービスのchange_status(引数)関数を呼び出す
        return redirect('/order');
    }

    public function download( Request $request )     // csv
    {
        $csv = $this->stockService->download($request);           // stockサービスのdownload関数,引数($request)を渡して呼び出し変数に代入
        return $csv;
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

