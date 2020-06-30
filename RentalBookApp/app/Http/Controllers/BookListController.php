<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class BookListController extends Controller
{
    /**
     * 図書一覧画面を表示
     * 
     */
    public function index(Request $request){
        $books = Book::with('user')->paginate(12);
        return view('booklist', ['books' => $books]);
    }
}
