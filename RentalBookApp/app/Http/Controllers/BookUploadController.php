<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use Carbon\Carbon;
use \InterventionImage;
use Illuminate\Support\Facades\File;


class BookUploadController extends Controller
{
    /**
     * 図書アップロード画面を表示
     * 
     */
    public function uplode(Request $request)
    {
        return view('bookupload');
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
            'bookImagePath.mimes' => '画像ファイルではありません。',
            'title.required' => '題名が未入力です。',
            'title.max' => '35文字以内で入力して下さい。',
            'body.max' => '200文字以内で入力して下さい。'
        ];
        $this->validate($request, $validate_rule, $messages);

        //現在の日時取得
        $now = Carbon::now();
        $now = $now->format('Ymdhms'); 

        //アップロードされたファイルを保存
        $user_id = $request->session()->get('user_id');
        $folder_path =  storage_path().'/app/public/'. $user_id;
        $file = $request->file('bookImagePath');
        $old_file_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $file_extension = '.'.$file->getClientOriginalExtension();
        $new_file_name = $old_file_name.$now.$file_extension;
        
        //ストレージにユーザーidフォルダがない場合
        if(!File::exists($folder_path)) {
            File::makeDirectory($folder_path);
        }
        
        //ストレージにユーザーidフォルダがある場合
        $file_save_result = false;
        if(File::exists($folder_path)){
            $file_save_result = InterventionImage::make($file)->resize(750, 750)->save($folder_path.'/' . $new_file_name );
        }

        //ファイルが保存された場合DBにデータを挿入
        $db_save_result = false;
        if ($file_save_result){
            $book_image_path = '/storage/'.$user_id.'/'.$new_file_name;
            $book = new Book;
            $book->user_id = $user_id;
            $book->title = $request->title;
            $book->body = $request->body;
            $book->book_image_path = $book_image_path;
            $db_save_result = $book->save();
        } else{
            //ファイルの保存が失敗した場合
            //エラーページを表示
        }

        //DBへの保存が成功した場合
        if ($db_save_result){
            return redirect()->route('mypage');
        } else{
            //DBへの保存が失敗した場合
            File::delete($folder_path.'/' . $new_file_name);
            //エラーページを表示
        }



    }
}