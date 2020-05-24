<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    //return view('welcome');
    return view('booklist');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/bookdetail', 'BookDetailController@index')->name('bookdetail');

Route::get('/mypage', 'MyPageController@index')->name('mypage');
Route::post('/mypage/bookSelect', 'MyPageController@bookSelect');
