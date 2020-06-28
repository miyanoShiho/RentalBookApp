<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MyPageController extends Controller
{
    // 貸出ステータス レンタル不可:0
    const RENTAL_HUKA = 1;

    /**
     * 初期表示(マイブック情報取得)
     * 
     * 
     */
    public function selectMyBookList(Request $request)
    {
        $user_id = $request->session()->get('user_id');
        $books = Book::userIdEqual($user_id)->get();
        return view('mypage', ['books' => $books]);
    }

    /**
     * 貸している本情報取得
     * 
     * 
     */
    public function selectGivebookList(Request $request)
    {
        $user_id = $request->session()->get('user_id');
        $books = Book::userIdEqual($user_id)->rentalStatusEqual(self::RENTAL_HUKA)->get();
        return view('mypage', ['books' => $books]);
    }

    /**
     * 借りている本情報取得
     * 
     * 
     */
    public function selectTakebookList(Request $request)
    {
        $user_id = $request->session()->get('user_id');
        $books = Book::rentalUserIdEqual($user_id)->rentalStatusEqual(self::RENTAL_HUKA)->get();
        return view('mypage', ['books' => $books]);
    }

    /**
     * 図書情報削除
     * 
     * 
     */
    public function bookDelete(Request $request)
    {
        $book_id = $request->input('hidBookId');
        $user_id = $request->session()->get('user_id');
        $book = Book::find($book_id);
        $file_name = basename($book->book_image_path);

        // イメージファイルの削除
        $folder_path =  storage_path() . '/app/public/' . $user_id;
        $delete_result = File::delete($folder_path . '/' . $file_name);
        // 図書貸出情報のデータを削除
        if ($delete_result) {
            Book::find($book_id)->delete();
        }
        // TODO:DB削除失敗した場合、共通エラー
        // 図書貸出情報取得
        $user_id = $request->session()->get('user_id');
        $books = Book::userIdEqual($user_id)->get();
        return view('mypage', ['books' => $books]);
    }
}
