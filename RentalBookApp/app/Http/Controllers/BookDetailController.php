<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Comment;
use App\Notice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookDetailController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, $book_id = '0')
    {
        $user_id = $request->session()->get('user_id');
        $books = Book::find($book_id);
        //　ログインユーザーによる表示分岐
        $display_flg = 'HIDE_BUTTON';
        /*
        下記の条件はレンタル申込・レンタル終了ボタンを非表示とする。
        ①ログインユーザーと図書の貸出人が一致する場合
        　図書が貸出可能な場合
        ②ログインユーザーと図書の貸出人が一致しない場合
        　図書が貸出中の場合
        ③ログインユーザーが存在しない場合
        */
        //　ログインユーザーが存在する場合
        if ($user_id != null) {
            if (
                $user_id != $books->user_id
                && $books->rental_status == '0'
            ) {
                //　ログインユーザーと図書の貸出人が一致しない場合
                //  図書が貸出可能な場合
                //  レンタル申込ボタンを表示する
                $display_flg = 'RENTAL_START_BUTTON';
            } elseif (
                $user_id == $books->user_id
                && $books->rental_status == '1'
            ) {
                //　ログインユーザーと図書の貸出人が一致する場合
                //　図書が貸出中の場合
                //  レンタル終了ボタンを表示する
                $display_flg = 'RENTAL_END_BUTTON';
            }
        }

        // レンタルステータス読み替え
        $books->rental_status = $books->rental_status == '0' ? 'レンタル可' : 'レンタル不可';
        // コメント情報取得
        $comments = Comment::select()
            ->where('book_id', $book_id)
            ->get();

        return view('bookdetail', compact('books', 'comments', 'display_flg', 'book_id', 'user_id'));
    }

    /**
     * 入力コメント情報登録処理.
     *
     */
    public function commentSave(Request $request)
    {
        //バリデーション
        $validate_rule = [
            'comment' => 'required',
        ];
        $messages = [
            'comment.required' => 'コメントが未入力です。'
        ];
        $this->validate($request, $validate_rule, $messages);

        // リクエストパラメータ
        $book_id = $request->input('book_id');
        $book_uid = $request->input('book_user_id');
        $user_id = $request->session()->get('user_id');
        $body = $request->input('comment');

        try {
            // トランザクション
            DB::transaction(function () use ($book_id, $user_id, $body, $book_uid) {
                //　コメントが初回であるか確認する。
                $commentCnt = Comment::bookIdEqual($book_id)->count();

                // コメント登録
                $comment = new Comment;
                $comment->user_id = $user_id;
                $comment->book_id = $book_id;
                $comment->body = $body;
                $comment->save();

                // 初回コメントの場合
                if ($commentCnt == 0) {
                    // お知らせテーブル登録
                    $notice = new Notice;
                    $notice->user_id = $book_uid;
                    $notice->book_id = $book_id;
                    $notice->body = $body;
                    $notice->save();
                } else {
                    // 2回目以降
                    // お知らせテーブル登録
                    $comments = Comment::select('user_id')
                        ->distinct()->where('book_id', $book_id)->where('user_id', '<>', $user_id)->get();

                    foreach ($comments as $target) {
                        $notice = new Notice;
                        $notice->user_id = $target->user_id;
                        $notice->book_id = $book_id;
                        $notice->body = $body;
                        $notice->save();
                    }
                }
            });
            return redirect()->route('bookdetail', ['book_id' => $book_id]);
        } catch (\Exception $e) {
            //ログ出力
            Log::error($e->getMessage());
            //エラー表示
            abort(500, 'Internal error. Fail to update book data');
        }
    }

    /**
     * コメント情報削除処理.
     *
     */
    public function commentDelete(Request $request)
    {
        // リクエストパラメータ
        $book_id = $request->input('book_id');
        $comment_id = $request->input('comment_id');
        try {
            DB::transaction(function () use ($comment_id) {
                Comment::commentIdEqual($comment_id)->delete();
            });
            return redirect()->route('bookdetail', ['book_id' => $book_id]);
        } catch (\Exception $e) {
            //ログ出力
            Log::error($e->getMessage());
            //エラー表示
            abort(500, 'Internal error. Fail to delete comment data');
        }
    }

    /**
     * お知らせ更新処理.
     *
     */
    public function updateNewFlg($book_id = '0', $notice_id = 0)
    {
        try {
            DB::transaction(function () use ($notice_id) {
                $notices  = Notice::find($notice_id);
                $notices->new_flag = 0;
                $notices->save();
            });
            return redirect()->route('bookdetail', ['book_id' => $book_id]);
        } catch (\Exception $e) {
            //ログ出力
            Log::error($e->getMessage());
            //エラー表示
            abort(500, 'Internal error. Fail to uddate notice data');
        }
    }
}
