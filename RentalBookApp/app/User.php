<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * UserのBookを取得
     */
    public function books()
    {
        return $this->hasMany('App\Book', 'user_id');
    }

    /**
     * UserのCommentを取得
     */
    public function comments()
    {
        return $this->hasMany('App\Comment', 'user_id');
    }

    /**
     * UserのNoticeを取得
     */
    public function notices()
    {
        return $this->hasMany('App\Notice', 'user_id');
    }


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
}
