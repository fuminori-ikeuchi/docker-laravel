<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Services\OfficialAccountService;
use Illuminate\Http\Request;
use App\User;   // userモデルを使う
use Log;

/**
 * Class UserController
 * ユーザー画面
 */
class UserController extends Controller
{
    // public function __construct(){
    //     $this->middleware('auth');
    // }
    const CREATE_USER_URL = '/create_user';

    const LOGIN_URL = '/login';

    // private $user_service;

    // public function __construct(
    //     UserService $user_service,
    //     OfficialAccountService $official_account_service
    // ) {
    //     $this->user_service = $user_service;
    //     $this->official_account_service = $official_account_service;
    // }

    // /**
    //  * ユーザー画面の表示
    //  *
    //  * @access public
    //  * @return void
    //  */
    // public function index()
    // {
    //     return view('manager.user.user');
    // }

    // /**
    //  * ユーザー新規登録画面の表示
    //  * ユーザー新規登録の処理
    //  *
    //  * @access public
    //  * @return void
    //  */
    public function register()    
    {
        return view('user.create');
    }

    public function create(Request $request)
    {
        try {
            if (!$request->has('email')) {                            // $request->has('email')、$requestに'email'があるか
                throw new \Exception('メールアドレスを指定してください。');
            }
            if (!$request->has('password')) {                         // $request->has('password')、$requestに'password'があるか
                throw new \Exception('パスワードを指定してください。');
            }
        
            $isEmail = User::hasEmail($request->email);               // 入力されたemailを引数にuserモデルの関数呼び出し
            if ($isEmail) {
                throw new \Exception('既に登録されているメールアドレスです。');   
            } else {
                // $test = $request->all();
                // Log::debug(print_r($test, true));
                // $aaa = $request->password_confirm;
                // Log::debug($aaa);          // 確認済み
                if ($request->password_confirm !== $request->password){
                    return redirect(self::CREATE_USER_URL);
                } else if ($request->password_confirm === $request->password) {
                    User::createUser($request->name, $request->email, $request->password, $request->password_confirm, $request->role);
                    return redirect(self::LOGIN_URL)->with('flash_message', 'ユーザー新規登録が完了しました。');
                }
                // Log::debug(print_r($eee, true));     // $eeeはUser::createUser($request->name, $request->email, $request->password, $request->role);
            }
            // $data = $this->user_service->createData($request->email, $request->password, 2);       
        } catch (\Exception $e) {
            $err_msg = $e->getMessage();
            return redirect(self::CREATE_USER_URL)->withInput()->withErrors($err_msg);
        }
    }
}