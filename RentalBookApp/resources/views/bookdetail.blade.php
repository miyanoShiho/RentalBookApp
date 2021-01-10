@extends('layouts.app')

@section('pageTitle','図書詳細画面')

@section('cssconf')
<link href="{{ asset('css/bookdetail.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __($books->title) }}</div>
                <div class="card-body">
                    <div class="row body-wrapper">
                        <div class="mx-auto image-wrapper">
                            <img class="w-100" src="{{ __($books->book_image_path) }}" />
                        </div>
                        <div class="rentalStatus w-100">
                            貸出状況：{{ __($books->rental_status) }}
                        </div>
                        <textarea class="w-100" cols=" 80" rows="5" placeholder="説明">{{ __($books->body) }}</textarea>
                        <div class="w-100">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="bg-secondary text-white">ユーザー名</th>
                                        <th>{{ __($books->user->name) }}</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="col-md-4">
                        </div>
                        <div class="col-12">
                            <form action="/bookdetail/commentDelete" method="POST">
                                @csrf
                                <div class="comment-wrapper">
                                    @foreach($comments as $comment)
                                    <div class="comment-box">
                                        <div class="w-100">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="bg-secondary text-white">ユーザー名</th>
                                                        <th>{{ __($comment->user->name) }}</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <div>
                                            <label>{{$comment->body}}</label>
                                        </div>
                                        <input type="hidden" name="comment_id" value="{{$comment->comment_id}}">
                                        <input type="hidden" name="book_id" value="{{$book_id}}">
                                        @if($user_id == $books->user_id)
                                        <input type="submit" class="btn btn-secondary float-right" name="delete" onClick="delete_alert(event);return false;" value="削除">
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                            </form>
                        </div>
                        <form action="/bookdetail/commentSave" method="POST">
                            @csrf
                            <table>
                                @if ($errors->has('comment'))
                                <div class="alert-danger">{{$errors->first('comment')}}</div>
                                @endif
                                <tr>
                                    <td>
                                        <textarea class="w-100" cols="80" rows="5" placeholder="コメント" name="comment">{{ old('comment') }}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="hidden" name="book_id" value="{{$book_id}}">
                                        <input type="hidden" name="book_user_id" value="{{$books->user_id}}">
                                        <input type="submit" class="btn bg-secondary text-white w-100" value="コメント送信">
                                    </td>
                                </tr>
                            </table>
                        </form>
                        @if($display_flg == 'RENTAL_START_BUTTON')
                        <a class="btn bg-danger text-white w-100" href="{{ route('rentalOffer',['book_id'=> $books->book_id]) }}">レンタル申し込み</a>
                        @elseif($display_flg == 'RENTAL_END_BUTTON')
                        <a class="btn bg-danger text-white w-100" href="{{ route('rentalFinish',['book_id'=> $books->book_id]) }}">レンタル終了</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
    @section('jsconf')
    <script src="{{ asset('/js/common.js') }}"></script>
    @endsection