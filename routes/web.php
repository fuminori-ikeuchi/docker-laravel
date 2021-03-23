<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(["namespace" => "Home"], function(){
    Route::get('/', 'HomeController@index');

    // Route::get('/', 'StockController@index');
    // Route::get('stock/{id}', 'StockController@show');
    // Route::get('stock/new', 'StockController@new');
    // Route::post('stock', 'StockController@create');
    // Route::get('stock/{id}/edit', 'StockController@edit');
    // Route::put('stock/{id}', 'StockController@update');
    // Route::delete('stock/{id}', 'StockController@destroy');
});
// Route::get('signup', 'UserController@new');
// Route::get('login', 'SessionController@new');
// Route::post('login', 'SessionController@create');
// Route::delete('logout', 'SessionController@destroy');






