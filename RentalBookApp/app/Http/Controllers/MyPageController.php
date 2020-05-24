<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyPageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $books = Book::all();
        return view('mypage', ['books' => $books]);
    }

    public function bookSelect(Request $request)
    {
        // ユーザーID取得
        $id = Auth::id();
        // 押されたボタンの値
        $link = $request->input('link');
        $books = '';
        switch ($link) {
            case 'mybooksLink':
                $books = Book::userIdEqual($id)->get();
                break;
            case 'giveBooksLink':
                $books = Book::userIdEqual($id)->rentalStatusEqual(1)->get();
                break;
            case 'takeBooksLink':
                $books = Book::userIdEqual($id)->rentalStatusEqual(0)->get();
                break;
            default:
                $books = Book::all();
                break;
        }

        return view('mypage', ['books' => $books]);
    }
}
