<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Book;

class RentalOfferController extends Controller
{
    /**
     * レンタル申し込み画面を表示する
     * 
     * @param object $request
     * @param int $book_id
     */
    public function display(Request $request, $book_id = 0){
        //レンタルを申し込むbookの情報を取得
        $book = Book::find($book_id);

        //bookが貸出中の場合と、申し込んだユーザーがその本の所持するユーザーの場合、エラー画面へ遷移。
        $rental_status = $book->rental_status;
        $owner_user_id = $book->user_id;
        $offer_user_id = $request->session()->get('user_id');
        if ($rental_status == 1 || $owner_user_id == $offer_user_id) {
            //エラー表示
            abort(500, 'Internal error. Fail to offer for rental');
        }

        $title = $book->title;
        $offer_user = Auth::user();
        $offer_user_name = $offer_user->name;
        return view('offercheck', ['title' => $title, 'offer_user_name' => $offer_user_name, 
        'book_id' => $book_id]);
    }

    /**
     * レンタル申し込み処理を実行する
     */
    public function check(Request $request){
        $book_id = $request->hidBookId;
        $title = $request->hidTitle;
        $offer_user = Auth::user();
        $offer_user_id = $offer_user->id;
        $offer_user_name = $offer_user->name;

        //図書情報を更新
        $book = Book::where('book_id', $book_id)->where('rental_status', 0)->first();
        $book->rental_status = 1;
        $book->rental_user_id = $offer_user_id;
        $result = $book->save();
        
        if ($result){
            return view('offercomplete', ['title' => $title, 'offer_user_name' => $offer_user_name, 
            'book_id' => $book_id]);
        } else {
            //エラー表示
            abort(500, 'Internal error. Fail to update book data');
        }
    }

}
