<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    const MANAGER_SYSTEM_LOGIN_URL = '/manager/system/login';
    const MANAGER_SYSTEM_HOME_URL = '/manager/system/home';

    const MANAGER_USER_LOGIN_URL = '/manager/user/login';
    const MANAGER_USER_HOME_URL = '/manager/user/home';

    /**
     * ログイン処理
     *
     * @param Request $request
     * @return redirect
     */
    public function login(Request $request)
    {
        $this->setCredentials($request);

        if (Auth::attempt($this->credentials)) {
            // ログイン成功時の処理
            $user = Auth::user();
            $request->session()->regenerate();
            $this->setSuccessRedirectUrl($user->role_id);

            return redirect($this->success_redirect_url);
        }

        // ログイン失敗時の処理
        $this->setFailedRedirectUrl();
        return redirect($this->failed_redirect_url)->withInput()->withErrors(config('constants.ERRORS.AUTHENTICATION_FAILED.MSG'));
    }

    /**
     * クレデンシャル情報をセット
     *
     * @param Request $request
     * @return void
     */
    private function setCredentials(Request $request): void
    {
        $this->credentials = [
            'email'     => $request->input('email', null),
            'password'  => $request->input('password', null),
            'role_id'   => $request->input('role_id', config('constants.ROLES.USER')),
            'is_active' => $request->input('is_active', config('constants.IS_ACTIVE.ON')),
        ];
    }

    /**
     * 成功時のリダイレクトURLをセット
     *
     * @param int $role_id
     * @return void
     */
    private function setSuccessRedirectUrl(int $role_id): void
    {
        if ($role_id === config('constants.ROLES.SYSTEM')) {
            $this->success_redirect_url = self::MANAGER_SYSTEM_HOME_URL;
        } else if ($role_id === config('constants.ROLES.USER')) {
            $this->success_redirect_url = self::MANAGER_USER_HOME_URL;
        }
    }

    /**
     * 失敗時のリダイレクトURLをセット
     *
     * @return void
     */
    private function setFailedRedirectUrl(): void
    {
        if ((int)$this->credentials['role_id'] === config('constants.ROLES.SYSTEM')) {
            $this->failed_redirect_url = self::MANAGER_SYSTEM_LOGIN_URL;
        } else if ((int)$this->credentials['role_id'] === config('constants.ROLES.USER')) {
            $this->failed_redirect_url = self::MANAGER_USER_LOGIN_URL;
        }
    }

    /**
     * logout
     * ログアウト処理
     *
     * @param Request $request
     * @access public
     * @return void
     */
    public function logout()
    {
        $user = Auth::user();

        // if ($user->role_id === config('constants.ROLES.SYSTEM')) {
        //     $this->failed_redirect_url = self::MANAGER_SYSTEM_LOGIN_URL;
        // } else if ($user->role_id === config('constants.ROLES.USER')) {
        //     $this->failed_redirect_url = self::MANAGER_USER_LOGIN_URL;
        // }

        Auth::logout();

        return redirect("/login");
    }
}