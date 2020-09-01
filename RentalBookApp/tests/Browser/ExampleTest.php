<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

// 画面遷移テスト
class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */

    // 図書一覧(ホーム)
    public function testBookList()
    {
        $this->browse(function (Browser $browser) {
            $title = '図書一覧';
            $browser->visit('http://localhost:8000/')
                ->assertTitle($title)
                ->screenshot('home');
        });
    }

    // 新規登録画面　登録完了画面
    public function testRegister()
    {
        //　新規登録のため、毎回修正してあげる必要がある
        $this->browse(function (Browser $browser) {
            $title = '新規登録画面';
            $linkText = 'ログアウト';
            $browser->visit('http://localhost:8000/register')
                ->assertTitle($title)
                ->screenshot('register')
                ->type('name', 'dusk4')
                ->type('email', 'dusk4@gmail.com')
                ->type('password', 'test8888')
                ->type('password_confirmation', 'test8888')
                ->screenshot('register_type')
                ->click('.btn-primary')
                ->screenshot('registerComplete')
                ->clickLink($linkText)
                ->screenshot('logout_after');
        });
    }
    // ログイン画面
    public function testLogin()
    {
        $this->browse(function (Browser $browser) {
            $title = 'ログイン画面';
            $browser->visit('http://localhost:8000/login')
                ->assertTitle($title)
                ->screenshot('login')
                ->type('email', 'test1@gmail.com')
                ->type('password', 'kn08XYFaRB6QDhjxQP')
                ->screenshot('login_type')
                ->click('.btn-primary')
                ->assertSee('BookMe')
                ->screenshot('booklist');
        });
    }

    // マイページ
    public function testMypage()
    {
        $this->browse(function (Browser $browser) {
            $title = 'マイページ';
            $browser->visit('http://localhost:8000/mypage/selectMyBookList')
                ->assertTitle($title)
                ->screenshot('mypage');
        });
    }

    // 図書編集
    public function testBookUpdate()
    {
        $this->browse(function (Browser $browser) {
            $title = '図書編集';
            $browser->visit('http://localhost:8000/bookUpdate/1')
                ->assertTitle($title)
                ->screenshot('bookUpdate');
        });
    }

    // マイページ(貸している本)
    public function testSelectGivebookList()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://localhost:8000/mypage/selectGivebookList')
                ->assertPathIs('/mypage/selectGivebookList')
                ->screenshot('selectGivebookList');
        });
    }

    // マイページ(借りている本)
    public function testSelectTakebookList()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://localhost:8000/mypage/selectTakebookList')
                ->assertPathIs('/mypage/selectTakebookList')
                ->screenshot('selectTakebookList');
        });
    }

    // 図書アップロード画面
    public function testBookUpload()
    {
        $this->browse(function (Browser $browser) {
            $title = '図書アップロード';
            $browser->visit('http://localhost:8000/bookUpload')
                ->assertTitle($title)
                ->screenshot('bookUpload');
        });
    }

    // 図書詳細画面
    public function testBookdetail()
    {
        $this->browse(function (Browser $browser) {
            $title = '図書詳細画面';
            $browser->visit('http://localhost:8000/bookdetail/1')
                ->assertTitle($title)
                ->screenshot('bookdatail');
        });
    }

    // レンタル申込確認 レンタル申込完了
    public function testRentalOffer()
    {
        $this->browse(function (Browser $browser) {
            $title = 'レンタル申込確認';
            $browser->visit('http://localhost:8000/rentalOffer/1')
                ->assertTitle($title)
                ->screenshot('RentalOffer')
                ->click('.btn-primary')
                ->screenshot('offerCheck');
        });
    }


    // レンタル終了確認
    public function testrentalFinish()
    {
        $this->browse(function (Browser $browser) {
            $title = 'レンタル終了確認';
            $browser->visit('http://localhost:8000/rentalFinish/3')
                ->assertTitle($title)
                ->screenshot('rentalFinish');
        });
    }

    // 共通エラー画面
    public function testError()
    {
        $this->browse(function (Browser $browser) {
            $title = '共通エラー画面';
            $browser->visit('http://localhost:8000/a')
                ->assertTitle($title)
                ->screenshot('errorCommon');
        });
    }
}
