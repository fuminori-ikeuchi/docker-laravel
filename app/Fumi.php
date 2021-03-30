<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;     // ハッシュ使う
use App\Models\Base as ModelBase;
use Illuminate\Database\Eloquent\Collection;


class User extends Authenticatable
{
    /**
     * モデルと関連しているテーブル
     *
     * @var string
     */
    protected $table = 'users';
    // use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
        return self::firstWhere("email", $email);
        // return "ふみのり";
        // return $data !== null ? true : false;
    }

    public static function createUser($name, $email, $password)
    {
        $create = [
            "name" => $name,
            "email" => $email,
            "password" => Hash::make($password),   //注意
        ];
        return self::create($create);
    }
    
}