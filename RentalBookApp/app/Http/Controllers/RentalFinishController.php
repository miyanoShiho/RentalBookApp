<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Book;
use App\User;

class RentalFinishController extends Controller
{
    /**
     * レンタル終了画面を表示する
     * 
     * @param object $request
     * @param int $book_id
     */
    public function display(Request $request, $book_id = 0){
        //bookの情報を取得
        $book = Book::find($book_id);

        //bookが貸出可の場合と、ログインユーザーと図書貸し出し人が一致しない場合、エラー画面へ遷移
        $rental_status = $book->rental_status;
        $offer_user_id = $book->rental_user_id;
        $offer_user_name = User::find($offer_user_id)->name;
        $owner_user_id = $book->user_id;
        $login_user_id = $request->session()->get('user_id');
        if ($rental_status == 0 || $owner_user_id != $login_user_id) {
            //エラー表示
            abort(500, 'Internal error. Fail to finish rental');
        }   

        $title = $book->title;
        return view('finishcheck', ['title' => $title, 'offer_user_name' => $offer_user_name, 
        'book_id' => $book_id]);
    }

    /**
     * レンタル終了処理を実行する
     * 
     */
    public function check(Request $request){
        //申し込み情報を取得
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
            abort(500, 'Internal error. Fail to update book data');
        }
    }

}
