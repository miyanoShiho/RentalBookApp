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
        // TODO:図書一覧からbook_idを取得
        $books = Book::userIdEqual(1)->first();

        //　ログインユーザーによる表示分岐
        if ($request->session()->get('user_id') != null) {
            if ($request->session()->get('user_id') == $books->user_id) {
                //　ログインユーザーと図書の貸出人が一致する場合
                if ($books->rental_status == 1) {
                    $displayFlg = 1;
                } else {
                    $displayFlg = 0;
                }
            } else {
                // ログインユーザーと図書の貸出人が一致しない場合
                $displayFlg = 2;
            }
        } else {
            $displayFlg = 3;
        }

        // レンタルステータス読み替え
        $books->rental_status = $books->rental_status == 0 ? 'レンタル可' : 'レンタル不可';
        // コメント情報取得
        $comments = Comment::select()
            ->join('users', 'users.id', '=', 'comments.user_id')
            ->where('users.id', $request->data[0]['userId'])->get();

        //print_r($comments);
        return view('bookdetail', compact('books', 'comments', 'displayFlg'));
    }

    /**
     * 入力コメント情報登録処理.
     *
     */
    public function commentSave(Request $request)
    {
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
