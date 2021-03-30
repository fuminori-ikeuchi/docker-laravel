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

//ログアウト
Route::get('/logout', 'AuthController@logout');
// ログイン画面の表示
Route::get('/login', 'LoginController@index')->name('login');   // ->name('login')をつけることで未ログイン時の操作はログインに戻るようになる
Route::post('/login', 'LoginController@login');
// ユーザー新規登録画面
Route::get('/create_user', 'UserController@register');
Route::post('/create_user', 'UserController@create');

Route::group(['middleware' => 'auth'], function() {       // この中のルーティングはログインしないとさわれない（ログインに戻る）
    Route::group(["namespace" => "Home"], function(){
        
        //在庫
        Route::get('/', 'HomeController@index');            
        Route::get('/register', 'HomeController@register');
        Route::post('/register', 'HomeController@create');
        Route::get('/check/{id}', 'HomeController@check');
        
        //発注
        Route::get('/order', 'HomeController@o_index');
        Route::get('/o_register', 'HomeController@o_register');
        Route::post('/o_register', 'HomeController@o_create');
        Route::get('/status/{id}', 'HomeController@status');
        Route::post('/status', 'HomeController@change_status');     // {id}なくても大丈夫
    });
});

// Route::get('signup', 'UserController@new');
// Route::get('login', 'SessionController@new');
// Route::post('login', 'SessionController@create');
// Route::delete('logout', 'SessionController@destroy');






