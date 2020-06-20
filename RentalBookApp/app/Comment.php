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

    /**
     * 条件：comment_idで取得
     */
    public function scopeCommentIdEqual($query, $comment_id)
    {
        return $query->where('comment_id', $comment_id);
    }
}
