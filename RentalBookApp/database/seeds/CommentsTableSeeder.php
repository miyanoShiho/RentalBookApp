<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->truncate();

        $now = Carbon::now();
        DB::table('comments')->insert(
            [
                [
                    'comment_id' => 1,
                    'user_id' => 2,
                    'book_id' => 1,
                    'body' => 'お借りしたいです',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'comment_id' => 2,
                    'user_id' => 1,
                    'book_id' => 1,
                    'body' => 'OKです',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'comment_id' => 3,
                    'user_id' => 2,
                    'book_id' => 1,
                    'body' => 'ありがとうございます',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
            ]
        );
    }
}
