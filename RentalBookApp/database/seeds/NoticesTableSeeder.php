<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class NoticesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notices')->truncate();

        $now = Carbon::now();
        DB::table('notices')->insert(
            [
                [
                    'notice_id' => 1,
                    'user_id' => 2,
                    'book_id' => 1,
                    'body' => '太郎が書籍「books」をレンタルしました  2020/03/25 23:59',
                    'new_flag' => '1',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'notice_id' => 2,
                    'user_id' => 1,
                    'book_id' => 1,
                    'body' => '木村拓也が書籍「books」をレンタルしました  2020/03/25 23:59',
                    'new_flag' => '1',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'notice_id' => 3,
                    'user_id' => 1,
                    'book_id' => 1,
                    'body' => 'SMAPが書籍「M 愛すべき人がいて」をレンタルしました  2020/03/25 23:59',
                    'new_flag' => '1',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
            ]
        );
    }
}
