<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->truncate();

        $now = Carbon::now();
        DB::table('books')->insert(
            [
                [
                    'book_id' => 1,
                    'user_id' => 1,
                    'rental_user_id' => 2,
                    'title' => '鬼滅の刃16巻',
                    'body' => '鬼滅の刃16巻です',
                    'book_image_path' => '/storage/kimetu16.jpg',
                    'rental_status' => 0,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'book_id' => 2,
                    'user_id' => 2,
                    'rental_user_id' => 1,
                    'title' => '鬼滅の刃17巻',
                    'body' => '鬼滅の刃17巻です',
                    'book_image_path' => '/storage/kimetu17.jpg',
                    'rental_status' => 0,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'book_id' => 3,
                    'user_id' => 3,
                    'rental_user_id' => 3,
                    'title' => '鬼滅の刃18巻',
                    'body' => '鬼滅の刃18巻です',
                    'book_image_path' => '/storage/kimetu18.jpg',
                    'rental_status' => 1,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
            ]
        );
    }
}
