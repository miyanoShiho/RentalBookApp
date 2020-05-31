<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class MyPageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('mypage');
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

    public function selectMybookList(Request $request)
    {
        // ユーザーID取得-> middlewere before
        //print_r($request->data[0]['userId']);
        $books = Book::userIdEqual($request->data[0]['userId'])->get();
        // 画面表示-> middlewere after
        return view('mypage', ['books' => $books]);
    }

    public function selectGivebookList(Request $request)
    {
        $books = Book::userIdEqual($request->data[0]['userId'])->rentalStatusEqual(1)->get();
        return view('mypage', ['books' => $books]);
    }

    public function selectTakebookList(Request $request)
    {
        $books = Book::userIdEqual($request->data[0]['userId'])->rentalStatusEqual(0)->get();
        return view('mypage', ['books' => $books]);
    }
}
