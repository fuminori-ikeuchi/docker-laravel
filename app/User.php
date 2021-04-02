<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Support\Facades\Hash;     // ハッシュ使う 登録時に文字化けさせている
use App\Models\Base as ModelBase;
use Illuminate\Database\Eloquent\Collection;
use Log;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [                                    // 新規で登録する場合、$fillable（許可）設定
        'name', 'email', 'password', 'password_confirm', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function hasEmail($email)
    {
        return self::firstWhere("email", $email);                  // このemailがあるかどうか（重複防止）
        // return $data !== null ? true : false;
    }

    public static function createUser($name, $email, $password, $password_c, $role)
    {
        $create = [
            "name" => $name,
            "email" => $email,
            "password" => Hash::make($password),   // 注意
            "password_confirm" => Hash::make($password_c),
            "role" => $role,
        ];
        
        // Log::debug(print_r($create, true));
        self::create($create);                               // 登録後
    }
}
