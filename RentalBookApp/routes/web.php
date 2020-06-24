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


Route::get('/', 'BookListController@index')->name('bookList');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/bookdetail/{bookId?}', 'BookDetailController@index')->name('bookdetail');
Route::post('/bookdetail/commentSave', 'BookDetailController@commentSave');
Route::post('/bookdetail/commentDelete', 'BookDetailController@commentDelete');

Route::get('/mypage', 'MyPageController@index')->name('mypage');
Route::get('/mypage/selectMybookList', 'MyPageController@selectMybookList')->name('selectMybookList');
Route::get('/mypage/selectGivebookList', 'MyPageController@selectGivebookList')->name('selectGivebookList');
Route::get('/mypage/selectTakebookList', 'MyPageController@selectTakebookList')->name('selectTakebookList');

Route::get('/bookUpload', 'BookUploadController@uplode')->name('bookUpload')->middleware('auth:web');
Route::post('/bookSave', 'BookUploadController@save')->name('bookSave');
