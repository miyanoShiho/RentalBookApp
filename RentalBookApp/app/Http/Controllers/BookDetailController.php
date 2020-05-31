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
        // レンタルステータス読み替え
        $books->rental_status = $books->rental_status == 0 ? 'レンタル可' : 'レンタル不可';
        // コメント情報取得
        $comments = Comment::select()
            ->join('users', 'users.id', '=', 'comments.user_id')
            ->where('users.id', $request->data[0]['userId'])->get();
        //print_r($comments);
        return view('bookdetail', compact('books', 'comments'));
    }
}
