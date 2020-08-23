<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use Carbon\Carbon;
use \InterventionImage;
use Illuminate\Support\Facades\File;

class BookUpdateController extends Controller
{
    /**
     * 図書編集画面を表示
     * 
     */
    public function update(Request $request, $book_id = '0')
    {
        //図書情報取得
        $book = Book::find($book_id);
        return view('bookupdate', ['book' => $book]);
    }

    /**
     * 図書情報を保存
     * 
     */
    public function save(Request $request)
    {
        //バリデーション
        $validate_rule = [
            'bookImagePath' => 'file|image|mimes:jpeg,png,jpg',
            'title' => 'required|max:35',
            'body' => 'max:200',
        ];
        $messages = [
            'bookImagePath.mimes' => '画像ファイルではありません。',
            'title.required' => '題名が未入力です。',
            'title.max' => '35文字以内で入力して下さい。',
            'body.max' => '200文字以内で入力して下さい。'
        ];
        $this->validate($request, $validate_rule, $messages);

        //ファイルが選択された場合ファイルを保存
        $file_save_result = false;
        $folder_path;
        $new_file_name;
        if ($request->file('bookImagePath')) {
            //現在の日時取得
            $now = Carbon::now();
            $now = $now->format('Ymdhms');

            //アップロードされたファイルを保存
            $user_id = $request->session()->get('user_id');
            $folder_path =  storage_path() . '/app/public/' . $user_id;
            $file = $request->file('bookImagePath');
            $old_file_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $file_extension = '.' . $file->getClientOriginalExtension();
            $new_file_name = $old_file_name . $now . $file_extension;
            $file_save_result = InterventionImage::make($file)->resize(750, 750)->save($folder_path . '/' . $new_file_name);
            if (!$file_save_result) {
                abort(500, 'Internal error. Fail to save image');
            }
        }

        
        $db_save_result = false;
        $prev_file_name;
        if ($file_save_result) {
            //ファイルが保存された場合
            //DBにデータを挿入し、前ファイルを削除
            $book = Book::find($request->hidBookId);
            $prev_file_name = basename($book->book_image_path);
            $book->title = $request->title;
            $book->body = $request->body;
            $book_image_path = '/storage/' . $user_id . '/' . $new_file_name;
            $book->book_image_path = $book_image_path;
            $db_save_result = $book->save();
            if (!$db_save_result){
                //保存したファイルを削除
                File::delete($folder_path . '/' . $new_file_name);
                abort(500, 'Internal error. Fail to save db');
            }
            //前ファイルを削除
            File::delete($folder_path . '/' . $prev_file_name);
            
        } else {
            //ファイルが未選択の場合
            //DBにデータを挿入
            $book = Book::find($request->hidBookId);
            $book->title = $request->title;
            $book->body = $request->body;
            $db_save_result = $book->save();
            if (!$db_save_result){
                abort(500, 'Internal error. Fail to save db');
            }
        } 

        return redirect()->route('mypage');
    }
}
