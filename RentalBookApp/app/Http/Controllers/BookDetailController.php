<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Comment;
use App\Notice;

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
                $user_id == $books->user_id
                && $books->rental_status == '1'
            ) {
                //　ログインユーザーと図書の貸出人が一致する場合
                //  図書が貸出中の場合
                //  レンタル申込ボタンを表示する
                $display_flg = 'RENTAL_START_BUTTON';
            } elseif (
                $user_id != $books->user_id
                && $books->rental_status == '0'
            ) {
                //　ログインユーザーと図書の貸出人が一致しない場合
                //　図書が貸出可能な場合
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

        return view('bookdetail', compact('books', 'comments', 'display_flg', 'book_id'));
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
        $user_id = $request->session()->get('user_id');
        $body = $request->input('comment');

        //　コメントが初回であるか確認する。
        $commentCnt = Comment::bookIdEqual($book_id)->count();

        $comment = new Comment;
        $comment->user_id = $user_id;
        $comment->book_id = $book_id;
        $comment->body = $body;
        $comment->save();

        // 初回コメントの場合
        if ($commentCnt == 0) {
            // お知らせテーブル登録
            $notice = new Notice;
            $notice->user_id = $user_id;
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
        return redirect()->route('bookdetail', ['book_id' => $book_id]);
    }

    /**
     * コメント情報削除処理.
     *
     */
    public function commentDelete(Request $request)
    {
        // リクエストパラメータ
        $book_id = $request->input('book_id');
        Comment::commentIdEqual($request->input('comment_id'))->delete();
        return redirect()->route('bookdetail', ['book_id' => $book_id]);
    }

    /**
     * お知らせ更新処理.
     *
     */
    public function updateNewFlg($book_id = '0', $new_flg = 0, $notice_id = 0)
    {
        // お知らせ情報が新しい場合、newフラグを更新する。
        if ($new_flg == 1) {
            $notices  = Notice::find($notice_id);
            $notices->new_flag = 0;
            $notices->save();
        }
        return redirect()->route('bookdetail', ['book_id' => $book_id]);
    }
}
