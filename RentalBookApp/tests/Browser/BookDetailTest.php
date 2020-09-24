<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Tests\Browser\Components\dbLog;
use Tests\Browser\Pages\login;
use Tests\Browser\Pages\BookDatail;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

/**
 * 図書詳細　各処理
 *
 */
class BookDetailTest extends DuskTestCase
{
    private $loginUser1 = array(
        "email" => "test1@gmail.com",
        "pass" => "kn08XYFaRB6QDhjxQP",
    );

    private $loginUser2 = array(
        "email" => "test2@gmail.com",
        "pass" => "lLRKvzU2nwpHhoBJ6E",
    );
    private $linkButton = '確定';


    // ログイン無し
    public function testNotLogin()
    {
        Log::info("--duskテスト実行開始--");
        $this->testBookdetail("ログイン無_図書詳細画面", "ログイン無_図書詳細情報");
    }

    // ログイン有り
    public function testLogin(array $array = null)
    {
        if ($array == null) {
            $array = $this->loginUser1;
        }
        $this->browse(function (Browser $browser) use ($array) {
            $browser->visit(new Login)
                ->loginPress($array);
        });
    }

    // 図書詳細画面
    public function testBookdetail($screenTitle = "図書詳細画面初期遷移", $logTitle = "図書詳細情報取得")
    {
        // 登録されているブックID
        $book_id = 11;

        $this->browse(function (Browser $browser) use ($book_id, $screenTitle) {

            $browser->visit(new BookDatail($book_id))
                ->screenshot('bookdatail_init_id:' . $screenTitle . '_01');
            $browser->driver->executeScript('window.scrollTo(0, 1500);');

            $browser->screenshot('bookdatail_init_id:' . $screenTitle . '_02');
        });

        // 表示されている図書詳細情報のDB検証
        $log = new dbLog();
        $log->selectBookdetailList($book_id, $logTitle);
    }

    // コメント確定ボタン押下
    public function testAddComment()
    {
        // 事前：追加されたコメント情報のDB検証
        $sysdate = Carbon::now();
        $log = new dbLog();
        $log->selectAddComment($sysdate);
        $this->browse(function (Browser $browser) {
            $comment = 'これはduskです';
            $browser->type('comment', $comment)
                ->screenshot('bookdetail_comment')
                ->assertInputValue('comment', $comment)
                ->press('コメント送信');
        });
        // 事後:追加されたコメント情報のDB検証
        $log = new dbLog();
        $log->selectAddComment($sysdate);
    }

    // レンタル申し込みボタン押下
    public function testRentalStart()
    {
        $this->testLogout();
        $this->testLogin($this->loginUser2);
        $this->testBookdetail("レンタル申込", "レンタル申込前_図書詳細情報");
        $this->browse(function (Browser $browser) {
            $linkText = 'レンタル申し込み';

            $title = 'レンタル申込確認';
            // レンタル申し込みボタン押下
            $browser->clickLink($linkText)
                ->screenshot('bookdetail_rental_start')
                ->assertTitle($title);
            // 確定ボタン押下(レンタル終了のためのレンタル開始更新)
            $browser->press($this->linkButton);
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
        $this->testBookdetail("レンタル終了", "レンタル申込後_図書詳細情報");
        $this->browse(function (Browser $browser) {
            $linkText = 'レンタル終了';
            $assertText = 'レンタル終了確認';
            $browser->clickLink($linkText)
                ->screenshot('bookdetail_rental_end')
                ->assertTitle($assertText);
            // 確定ボタン押下(テストリセットのためのレンタル終了更新)
            $browser->press($this->linkButton);
        });
        Log::info("--duskテスト実行終了--");
    }
}
