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
     * モデルのタイムスタンプを更新するかの指示
     *
     * @var bool
     */
    public $timestamps = false;

    // ローカルスコープ　scopeの文字を抜いて呼び出す
    // 呼び出し方　scopeuserIdEqual　→　userIdEqual
    public function scopeuserIdEqual($query, $id)
    {
        return $query->where('user_id', $id);
    }

    public function scoperentalStatusEqual($query, $status)
    {
        return $query->where('rental_status', $status);
    }
}
