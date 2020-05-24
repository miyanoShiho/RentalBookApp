<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

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
