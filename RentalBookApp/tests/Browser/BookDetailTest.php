<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Carbon\Carbon;

// 図書詳細　各処理
class BookDetailTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */

    // ログイン無し
    public function testNotLogin()
    {
        $this->testBookdetail();
    }

    // ログイン有り
    public function testLogin()
    {
        $this->browse(function (Browser $browser) {
            $title = 'ログイン画面';
            $browser->visit('http://localhost:8000/login')
                ->assertTitle($title)
                ->type('email', 'test1@gmail.com')
                ->type('password', 'kn08XYFaRB6QDhjxQP')
                ->click('.btn-primary')
                ->assertSee('BookMe');
        });
    }

    // 図書詳細画面
    public function testBookdetail($book_id = null)
    {
        if ($book_id == null) {
            $this->testBookdetail(4);
        } else {
            $this->browse(function (Browser $browser) use ($book_id) {
                $title = '図書詳細画面';
                $browser->visit('http://localhost:8000/bookdetail/' . $book_id)
                    ->screenshot('bookdatail_init_id:' . $book_id . Carbon::now() . '_01');
                $browser->driver->executeScript('window.scrollTo(0, 1500);');

                $browser->screenshot('bookdatail_init_id:' . $book_id . Carbon::now() . '_02')
                    ->assertTitle($title);
            });
        }
    }

    // コメント確定ボタン押下
    public function testAddComment()
    {
        $this->browse(function (Browser $browser) {
            $comment = 'これはduskです';
            $browser->type('comment', $comment)
                ->screenshot('bookdetail_comment')
                ->assertSee($comment)
                ->press('コメント送信');
        });
    }

    // レンタル申し込みボタン押下
    public function testRentalStart()
    {
        $this->browse(function (Browser $browser) {
            $linkText = 'レンタル申し込み';
            $title = 'レンタル申込確認';
            $browser->clickLink($linkText)
                ->screenshot('bookdetail_rental_start')
                ->assertTitle($title);
        });
    }

    // ログアウト
    public function testLogout()
    {
        $this->browse(function (Browser $browser) {
            $logout = 'ログアウト';
            $linkText = 'ログイン';
            $browser->clickLink($logout)
                ->assertSee($linkText);
        });
    }

    // レンタル終了ボタン押下
    public function testRentalEnd()
    {
        $this->testLogin();
        $this->testBookdetail(3);
        $this->browse(function (Browser $browser) {
            $linkText = 'レンタル終了';
            $assertText = 'レンタル終了確認';
            $browser->clickLink($linkText)
                ->screenshot('bookdetail_rental_end')
                ->assertTitle($assertText);
        });
    }
}
