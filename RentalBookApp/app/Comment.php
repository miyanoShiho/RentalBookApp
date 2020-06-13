<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * commentsテーブルの主キー
     *
     * @var int
     */
    protected $primaryKey = 'comment_id';

    /**
     * commentを所有するBookを取得
     */
    public function book()
    {
        return $this->belongsTo('App\Book', 'book_id');
    }

    /**
     * commentを所有するUserを取得
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    //protected $primaryKey = ['comment_id', 'id'];

    // public function user()
    // {
    //     return $this->hasOne(User::class);
    // }
}
