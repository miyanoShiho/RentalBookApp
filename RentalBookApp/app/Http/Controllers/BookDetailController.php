<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Comment;

class BookDetailController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('bookdetail');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $userId = $request->session()->get('user_id');
        $books = Book::userIdEqual($userId)->first();
        //　ログインユーザーによる表示分岐
        $displayFlg = 'HIDE_BUTTON';
        /*
        下記の条件はレンタル申込・レンタル終了ボタンを非表示とする。
        ①ログインユーザーと図書の貸出人が一致する場合
        　図書が貸出可能な場合
        ②ログインユーザーと図書の貸出人が一致しない場合
        　図書が貸出中の場合
        ③ログインユーザーが存在しない場合
        */
        //　ログインユーザーが存在する場合
        if ($userId != null) {
            if (
                $userId == $books->user_id
                && $books->rental_status == '1'
            ) {
                //　ログインユーザーと図書の貸出人が一致する場合
                //  図書が貸出中の場合
                //  レンタル申込ボタンを表示する
                $displayFlg = 'RENTAL_START_BUTTON';
            } elseif (
                $userId != $books->user_id
                && $books->rental_status == '0'
            ) {
                //　ログインユーザーと図書の貸出人が一致しない場合
                //　図書が貸出可能な場合
                //  レンタル終了ボタンを表示する
                $displayFlg = 'RENTAL_END_BUTTON';
            }
        }

        // レンタルステータス読み替え
        $books->rental_status = $books->rental_status == '0' ? 'レンタル可' : 'レンタル不可';
        // コメント情報取得
        $comments = Comment::select()
            ->join('users', 'users.id', '=', 'comments.user_id')
            ->where('users.id', $userId)->get();

        //print_r($comments);
        return view('bookdetail', compact('books', 'comments', 'displayFlg'));
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

        $comment = new Comment;
        $comment->user_id = $request->session()->get('user_id');
        $comment->book_id = $request->input('book_id');
        $comment->body = $request->input('comment');
        $comment->save();
        return redirect()->route('bookdetail');
    }

    /**
     * コメント情報削除処理.
     *
     */
    public function commentDelete(Request $request)
    {
        Comment::commentIdEqual($request->input('comment_id'))->delete();
        return redirect()->route('bookdetail');
    }
}
