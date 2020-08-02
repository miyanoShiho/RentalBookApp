<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testLogin()
    {
        $this->browse(function (Browser $browser) {
            //　ログイン実行
            $browser->visit('http://localhost:8000/login')
                ->screenshot('login')
                ->type('email', 'test1@gmail.com')
                ->type('password', 'kn08XYFaRB6QDhjxQP')
                ->click('.btn-primary')
                ->assertSee('BookMe')
                ->screenshot('booklist');
        });
    }


    public function testBookdetail()
    {
        $this->browse(function (Browser $browser) {
            //　図書詳細画面へ遷移
            $linkText = '鬼滅の刃16巻_2';
            $browser->clickLink($linkText)
                ->screenshot('bookdetail');
        });
    }

    public function testAddComment()
    {
        $this->browse(function (Browser $browser) {
            //　図書詳細画面へ遷移
            $browser->type('comment', 'これはduskです')
                ->screenshot('bookdetail_comment')
                ->press('コメント送信');
        });
    }
}
