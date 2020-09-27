<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

/**
 * バリデーションテスト 図書アップロード画面
 */
class ValidateUploadTest extends DuskTestCase
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

    // 図書アップロード画面へ遷移
    public function testVisitBookUpload()
    {
        $this->browse(function (Browser $browser) {
            $title = '図書アップロード';
            $browser->visit('http://localhost:8000/bookUpload')
                ->screenshot('validate_bookupload')
                ->assertTitle($title);
        });
    }

    // バリデーション
    // ファイル選択フォーム
    // require
    public function testFileFormRequired()
    {
        $this->browse(function (Browser $browser) {
            $browser->click('.btn-primary')
                ->screenshot('validate_bookupload_fileform_required');
        });
    }

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
                $title = '図書アップロード';
                $browser->click('.btn-primary')
                    ->screenshot('validate_bookupload_fileform_mimes')
                    ->assertTitle($title);
            });
        }
    }

    // タイトル
    // required
    public function testTitleRequired()
    {
        $this->browse(function (Browser $browser) {
            $browser->click('.btn-primary');
            $browser->driver->executeScript('window.scrollTo(0, 950);');
            $browser->screenshot('validate_bookupload_title_required');
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
            $browser->screenshot('validate_bookupload_title_max');
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
            $browser->screenshot('validate_bookupload_body_max');
        });
    }

}
