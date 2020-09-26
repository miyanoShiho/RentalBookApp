<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

/**
 * バリデーションテスト 図書詳細画面 コメント
 */
class ValidateCommentTest extends DuskTestCase
{
    //　ログイン
    public function testLogin()
    {
        $this->browse(function (Browser $browser) {
            $title = 'ログイン画面';
            $browser->visit('http://localhost:8000/login')
                ->assertTitle($title)
                ->type('email', 'seiya@shimofuri')
                ->type('password', 'sosinadesu')
                ->click('.btn-primary')
                ->assertSee('BookMe');
        });
    }

    // 図書詳細画面へ遷移
    public function testVisitBookUp()
   {
       $this->browse(function (Browser $browser) {
           $title = '図書詳細画面';
           $browser->visit('http://localhost:8000/bookdetail/1')
               ->screenshot('validate_bookdetail')
               ->assertTitle($title);
       });
   }

   // バリデーションテスト
   // コメント
   // required
   public function testCommentRequired()
   {
        $this->browse(function (Browser $browser) {
            $browser->type('comment', '')
                ->click('.comment_submit');
            $browser->driver->executeScript('window.scrollTo(0, 950);');
            $browser->screenshot('validate_bookdetail_comment_required');
        });
   }

}
