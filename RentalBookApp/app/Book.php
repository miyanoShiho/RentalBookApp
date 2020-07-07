<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    /**
     * booksテーブルの主キー
     *
     * @var int
     */
    protected $primaryKey = 'book_id';

    /**
     * Bookを所有するUserを取得
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * BookのCommentを取得
     */
    public function comments()
    {
        return $this->hasMany('App\Comment', 'book_id');
    }

    /**
     * BookのNoticeを取得
     */
    public function notices()
    {
        return $this->hasMany('App\Notice', 'book_id');
    }

    /**
     * 条件：user_idで取得
     */
    public function scopeUserIdEqual($query, $id)
    {
        return $query->where('user_id', $id);
    }

    /**
     * 条件：rental_user_idで取得
     */
    public function scopeRentalUserIdEqual($query, $id)
    {
        return $query->where('rental_user_id', $id);
    }

    /**
     * 条件：rental_statusで取得
     */
    public function scopeRentalStatusEqual($query, $status)
    {
        return $query->where('rental_status', $status);
    }
}
