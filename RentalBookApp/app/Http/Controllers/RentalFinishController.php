<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Book;

class RentalOfferController extends Controller
{
    /**
     * レンタル終了画面を表示する
     * 
     * @param object $request
     * @param int $book_id
     */
    public function display(Request $request, $book_id = 0){
        $book = Book::find($book_id);
        $title = $book->title;
        $offer_user = Auth::user();
        $offer_user_name = $offer_user->name;
        return view('finishcheck', ['title' => $title, 'offer_user_name' => $offer_user_name, 
        'book_id' => $book_id]);
    }

    /**
     * レンタル終了処理を実行する
     */
    public function check(Request $request){
        $book_id = $request->hidBookId;
        $title = $request->hidTitle;
        $offer_user = Auth::user();
        $offer_user_id = $offer_user->id;
        $offer_user_name = $offer_user->name;

        //図書情報を更新
        $book = Book::where('book_id', $book_id)->where('rental_status', 1)->first();
        $book->rental_status = 0;
        $book->rental_user_id = null;
        $result = $book->save();
        
        if ($result){
            return view('finishcomplete', ['title' => $title, 'offer_user_name' => $offer_user_name, 
            'book_id' => $book_id]);
        } else {
            //エラー表示
        }
    }

}
