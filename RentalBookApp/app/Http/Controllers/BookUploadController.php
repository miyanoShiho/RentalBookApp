<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use Carbon\Carbon;
use \InterventionImage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


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
     * 図書情報を更新
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

        try {
            //アップロードされたファイルを保存
            $user_id = $request->session()->get('user_id');
            $folder_path =  storage_path().'/app/public/'. $user_id;
            $file = $request->file('bookImagePath');
            $old_file_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $file_extension = '.'.$file->getClientOriginalExtension();
            $new_file_name = $old_file_name.$now.$file_extension;
            
            //ストレージにユーザーidフォルダがない場合
            if(!File::exists($folder_path)) {
                //idフォルダを作成
                File::makeDirectory($folder_path);
            }
            
            //ファイルを保存
            InterventionImage::make($file)->resize(750, 750)->save($folder_path.'/' . $new_file_name );
        } catch (\Exception $e) {
            //ログ出力
            Log::error($e->getMessage());
            //httpエラーをスロー
            abort(500, 'Internal error. Fail to image file');
        }

        try{
            //DBにデータを挿入
            $book_image_path = '/storage/'.$user_id.'/'.$new_file_name;
            $book = new Book;
            $book->user_id = $user_id;
            $book->title = $request->title;
            $book->body = $request->body;
            $book->book_image_path = $book_image_path;
            $book->save();
        } catch(\Exception $e) {
            //DBへの保存が失敗した場合ファイルを削除
            File::delete($folder_path.'/' . $new_file_name);
            //ログ出力
            Log::error($e->getMessage());
            //httpエラーをスロー
            abort(500, 'Internal error. Fail to save db');
        }
        
        return redirect()->route('mypage');
            
    }
}