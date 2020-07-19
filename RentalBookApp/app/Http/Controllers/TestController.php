<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //テストページを表示するためのコントローラ
    public function test()
    {
        $title = 'test';
        $offer_user_name = 'test';
        return view('offercomplete', ['title' => $title, 'offer_user_name'=>$offer_user_name]);
    }
}
