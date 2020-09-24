<?php

namespace Tests\Browser\Components;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Component as BaseComponent;
use App\Book;
use App\Comment;
use Illuminate\Support\Facades\Log;

class dbLog extends BaseComponent
{
    /**
     * Get the root selector for the component.
     *
     * @return string
     */
    public function selector()
    {
        return '#selector';
    }

    /**
     * Assert that the browser page contains the component.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        $browser->assertVisible($this->selector());
    }

    /**
     * Get the element shortcuts for the component.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@element' => '#selector',
        ];
    }

    public function selectBookdetailList($book_id, $logTitle)
    {
        // ログ出力の処理
        $books = Book::select()
            ->where('book_id', $book_id)
            ->get()
            ->toArray();
        Log::info($logTitle);
        Log::info($books);
    }
    public function selectAddComment($sysdate)
    {
        // ログ出力の処理
        $comments = Comment::select()
            ->where('updated_at', '>=', $sysdate)
            ->get()
            ->toArray();
        Log::info("コメント情報取得");
        Log::info($comments);
    }
}
