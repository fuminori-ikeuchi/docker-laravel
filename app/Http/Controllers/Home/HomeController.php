<?php

namespace App\Http\Controllers\Home;   //このファイルはどの階層にあるか

use App\Http\Controllers\Controller;   // Controller経由のため
// use App\Stock; 最初に書かれていた(useは何を使うか)
use Illuminate\Http\Request;  // リクエストされたものを取得できるように
use App\Models\Stock;   // stockモデルを使う
use App\Models\Order;   // orderモデルを使う
use Log;  // デバッグのため

use Symfony\Component\HttpFoundation\StreamedResponse;     // csv出力
use Illuminate\Database\Eloquent\Collection;

class HomeController extends Controller
{
    // public function __construct(){
    //     $this->middleware('auth');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()      //在庫一覧
    {
        $data = [
            "stock"         => Stock::getStocks()   // Stock::（モデルの）getStocks()（関数）を使用
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
            "order"         => Order::getOrders()   // Order::（モデルの）getOrders()（関数）を使用
        ];
        return view('order.index', $data);  // order/indexに、$dataを持たせてindexで使用
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
            "stock"         => Stock::getStocks()    // nameの情報を使っているため$dateを使用
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
        // $test = $request->all();               // 上記のリクエストの全て->all()を$testに
        // Log::debug(print_r($test, true));      // Log::debug('デバッグメッセージ')に配列として引数$testを渡している
        $create = [                               // $createに入力されたデータを配列に代入
            'name'     =>      $request->input('name', null),
            'o_num'      =>      $request->input('o_num', null)
        ];
        $record = Order::registerOrder($create);   // 登録したものをモデルからコントローラにreturnする（レコードで返される）
        // Log::debug($record->name);              // 入力された名前をとれるかのdebug
        $name = $record->name;                     // 入力された名前を変数に代入
        $stock_record = Stock::recordCheck($name);  // stockモデルでname検索し、ヒットしたレコード取得
        // Log::debug($stock_record->price);        // stockモデルでname検索したレコードのpriceが取得できるかの確認
        $update =[                                  // 先ほどnullありでデータベースに登録したレコードにstockモデルからとってきた情報をupdate
            'stock_id'  => $stock_record->id,
            'o_price'   => $stock_record->price * $request->input('o_num', null)   // 1個あたりの金額＊発注個数で発注金額
        ];
        Order::updateOrder($record->name, $update);      // updateする($record->name, $update)の左辺がどこにするか（->nameは->idでもなんでもok）、右辺が何を渡すか
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
            "order"         => Order::getStatus($o_id)   // nameの情報必要。Order::（モデルの）getStatus()（関数）を使用
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
        Order::change_status($o_id, $update);   // 第一引数（whereのため、idでもnameでも）がどの、第二引数がなにを

        $checker = Order::check($o_id);         // 変更したステータスのレコード
        // Log::debug(print_r($checker, true));   //個数取れる
        
        if ($checker['status'] == '発注受取済み') {                           // $o_idでとってきたレコードのステータス
            $getName = Stock::getChecker($checker->name);                   // 上記のレコード名(orderテ)と同じものを "stockテーブル" から取得
            // Log::debug(print_r($getName, true));  //stockテーブルの情報取得
            // Log::debug($getName->name);
            $update = [
                'num'     =>      $checker["o_num"] + $getName["num"]       // 発注個数(order)+在庫数(stock)をstockテーブルに保存
            ];
            Stock::totalNum($getName->name, $update);     // どこ(name),なにを渡す($update)をモデルに
        }
        // Log::debug($o_id);
        return redirect('/order');
    }

    public function download( Request $request )
    {

        $record =  Stock::getStocks();                     // １、表示させたいものを全部モデルからとってくる
        // $cvsList = [];
        $cvsList[] = ["id", "在庫", "在庫数", "金額/単価", "登録日"];   // ３、csv出力時のheaderになる部分を先に配列に入れる
        foreach ($record as $records) {                    // ２、１でとってきた全てをforeachにかける
            $cvsList[] = [
                // デバッグ(2-2)
                $records->id,    
                $records->name,
                $records->num,
                $records->price,
                $records->created_at,
            ];
            // Log::debug(print_r($records->name, true));   // ２−２、foreachの中でデバッグ（値がとれているか）
        }
        
        

        // Log::debug(print_r($cvsList, true));
        $response = new StreamedResponse (function() use ($request, $cvsList){
            $stream = fopen('php://output', 'w');

            //　文字化け回避
            stream_filter_prepend($stream,'convert.iconv.utf-8/cp932//TRANSLIT');

            // CSVデータ
            foreach($cvsList as $key => $value) {
                fputcsv($stream, $value);
            }
            fclose($stream);
        });
        $response->headers->set('Content-Type', 'application/octet-stream');
        $response->headers->set('Content-Disposition', 'attachment; filename="sample.csv"');
 
        return $response;
        
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

