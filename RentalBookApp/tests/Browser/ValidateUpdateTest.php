<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

/**
 * バリデーションテスト 図書編集画面
 */
class ValidateUpdateTest extends DuskTestCase
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

   // 図書編集画面へ遷移
   public function testVisitBookUpdate()
   {
       $this->browse(function (Browser $browser) {
           $title = '図書編集';
           $browser->visit('http://localhost:8000/bookUpdate/1')
               ->screenshot('validate_bookupdate')
               ->assertTitle($title);
       });
   }

   // バリデーション
   // ファイル選択フォーム
   // mimes
   public function testFileFormMimes()
   {
       try{
           $this->browse(function (Browser $browser) {
               $browser->attach('bookImagePath', __DIR__. '/test.text')
                    ->click('.btn-primary');
           });
       }catch(\Exception $e){
           $this->browse(function (Browser $browser) {
                $title = '図書編集';
                $browser->click('.btn-primary')
                    ->screenshot('validate_bookupdate_fileform_mimes')
                    ->assertTitle($title);
           });
       }
   }

    // タイトル
    // required
    public function testTitleRequired()
    {
        $this->browse(function (Browser $browser) {
            $browser->type('title', '')
                ->click('.btn-primary');
            $browser->driver->executeScript('window.scrollTo(0, 950);');
            $browser->screenshot('validate_bookupdate_title_required');
        });
    }

    // max
    public function testTitleMax()
    {
        $this->browse(function (Browser $browser) {
            // 36文字
            $titleText = 'ああああああああああああああああああああああああああああああああああああ';

            $browser->type('title', $titleText)
            ->click('.btn-primary');
            $browser->driver->executeScript('window.scrollTo(0, 950);');
            $browser->screenshot('validate_bookupdate_title_max');
        });
    }

    // ボディー
    // max
    public function testBodyMax()
    {
        $this->browse(function (Browser $browser) {
            // 201文字
            $bodyText = 'ああああああああああああああああああああああああああああああああああああああ
                        ああああああああああああああああああああああああああああああああああああああ
                        ああああああああああああああああああああああああああああああああああああああ
                        ああああああああああああああああああああああああああああああああああああああ
                        ああああああああああああああああああああああああああああああああああああああ
                        あああああああああああ';
            $browser->type('body', $bodyText)
            ->click('.btn-primary');
            $browser->driver->executeScript('window.scrollTo(0, 950);');
            $browser->screenshot('validate_bookupdate_body_max');
        });
    }
}
