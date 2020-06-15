<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class BookUploadController extends Controller
{
    /**
     * 図書アップロード画面を表示
     * 
     */
    public function uplode(Request $request)
    {
        return view('uplode');
    }

    /**
     * 図書情報を保存
     * 
     * 
     */
    public function save(Request $request){
        //バリデーション
        $validate_rule = [
            'bookImagePath' => 'required|file|image|mimes:jpeg,png,jpg',
            'title'=> 'required|max:35',
            'body' => 'max:200',
        ];
        $messages = [
            'bookImagePath.required' => '画像ファイルが選択されていません。',
            'bookImagePath.image' => '画像ファイルではありません。',
            'title.required' => '題名が未入力です。',
            'title.max' => '35文字以内で入力して下さい。',
            'body.max' => '200文字以内で入力して下さい。'
        ];
        $this->validate($request, $validate_rule, $messages);

        //アップロードされたファイルを保存
        $user_id = $request->session()->get('user_id');
        //$folder_path =  public_path().'/'. $user_id;
        $file_name = $request->bookImagePath->getClientOriginalName();

        $result = $request->bookImagePath->storeAs('public/'.$user_id, $file_name);

        if ($result){
            //$book_image_path = $folder_path.'/'.$file_name;
            $book_image_path = '/storage/'. $user_id. '/'. $file_name;
            $book = new Book;
            $book->user_id = $user_id;
            $book->title = $request->title;
            $book->body = $request->body;
            $book->book_image_path = $book_image_path;
            $book->save();
            return redirect()->route('mypage');
        }

        // //ストレージにユーザーidフォルダがない場合
        // if(!File::exists($path)) {
        //     $request->bookImagePath->storeAs('public/'.$user_id, $user_id.$file_name.'.jpg');
        // } elseif (File::exists($path)) {
        //     //ストレージにユーザーidフォルダがある場合

        // }
    }
}