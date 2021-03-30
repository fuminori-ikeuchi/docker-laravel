<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;        // ログインはモデルなし、AuthとAuth::attemptで動かしている

/**
 * Class LoginController
 * ログイン画面
 */
class LoginController extends Controller
{
    const LOGIN_URL = '/login';
    const HOME_URL = '/';

    public function __construct()
    {
        //
    }

    // /**
    //  * ログイン画面の表示
    //  *
    //  * @access public
    //  * @return void
    //  */
    public function index()
    {
        $data = [];

        return view('user.login', $data);
    }

    // /**
    //  * ログイン処理
    //  *
    //  * @param Request $request
    //  * @access public
    //  * @return void
    //  */
    public function login(Request $request)
    {
        $this->setCredentials($request);               

        if (Auth::attempt($this->credentials)) {       //　Auth::attemptはログインを試みる
                $request->session()->regenerate();     //  $request->session()->regenerate(); セッション発行
                return redirect(self::HOME_URL);
        }

        return redirect(self::LOGIN_URL)->withInput()->withErrors("どっちかまちがえてまっせ");    //  エラー文、withErrors("どっちかまちがえてまっせ")
    }

    // /**
    //  * クレデンシャル情報をセット
    //  *
    //  * @param Request $request
    //  * @return void
    //  */
    private function setCredentials(Request $request): void
    {
        $this->credentials = [
            'email'     => $request->input('email', null),
            'password'  => $request->input('password', null),
            // 'is_active' => $request->input('is_active', config('constants.IS_ACTIVE.ON')),
        ];
    }
}