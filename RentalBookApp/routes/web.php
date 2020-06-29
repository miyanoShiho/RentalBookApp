<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

 //authミドルウェアを適用するルート
Route::group(['middleware' => 'auth'], function () {
    Route::post('/bookdetail/commentSave', 'BookDetailController@commentSave');
    Route::post('/bookdetail/commentDelete', 'BookDetailController@commentDelete');

    Route::get('/bookUpload', 'BookUploadController@uplode')->name('bookUpload');
    Route::post('/bookSave', 'BookUploadController@save')->name('bookSave');

    Route::get('/bookUpdate/{book_id?}', 'BookUpdateController@update')->name('bookUpdate');
    Route::post('/updateSave', 'BookUpdateController@save')->name('updateSave');

    Route::get('/mypage/selectMyBookList', 'MyPageController@selectMyBookList')->name('mypage');
    Route::get('/mypage/selectGivebookList', 'MyPageController@selectGivebookList')->name('selectGivebookList');
    Route::get('/mypage/selectTakebookList', 'MyPageController@selectTakebookList')->name('selectTakebookList');
    Route::post('/mypage/bookDelete', 'MyPageController@bookDelete')->name('bookDelete');

});

Route::get('/', 'BookListController@index')->name('bookList');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/bookdetail/{book_id?}', 'BookDetailController@index')->name('bookdetail');
