<?php

use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'user_id' => 1,
            'rental_user_id' => 1,
            'title' => '鬼滅の刃16巻',
            'body' => '鬼滅の刃16巻です',
            'book_image_path' => '/storage/kimetu16.jpg',
        ];

        DB::table('books')->insert($param);

        $param = [
            'user_id' => 2,
            'rental_user_id' => 2,
            'title' => '鬼滅の刃17巻',
            'body' => '鬼滅の刃17巻です',
            'book_image_path' => '/storage/kimetu17.jpg',
        ];

        DB::table('books')->insert($param);

        $param = [
            'user_id' => 3,
            'rental_user_id' => 3,
            'title' => '鬼滅の刃18巻',
            'body' => '鬼滅の刃18巻です',
            'book_image_path' => '/storage/kimetu18.jpg',
            'rental_status' => 1,
        ];

        DB::table('books')->insert($param);
    }
}
