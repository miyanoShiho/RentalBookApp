@extends('layouts.app')

@section('cssconf')
<link href="{{ asset('css/bookdetail.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __($books->title) }}</div>
                <div class="card-body w-100">
                    <div class="row body-wrapper">
                        <img class="float-center" src="{{ __($books->book_image_path) }}" width="300" height="300">
                        <div class="rentalStatus w-100">
                            貸出状況：{{ __($books->rental_status) }}
                        </div>
                        <textarea cols="80" rows="5" placeholder="説明">{{ __($books->body) }}</textarea>
                        <div class="col-md-4">
                            <b>ユーザー名：{{ __($books->user->name) }}</b>
                        </div>
                        <div class="col-md-4">
                        </div>
                        <form action="/bookdetail/commentDelete" method="POST">
                            @csrf
                            <div class="comment-wrapper">
                                @foreach($comments as $comment)
                                <div>
                                    <label>{{$comment->user->name}}</label>
                                </div>
                                <div>
                                    <label>{{$comment->body}}</label>
                                </div>
                                <input type="hidden" name="comment_id" value="{{$comment->comment_id}}">
                                <input type="hidden" name="book_id" value="{{$book_id}}">
                                <input type="submit" class="btn btn-secondary float-right" name="delete" onClick="delete_alert(event);return false;" value="削除">
                                <hr>
                                @endforeach
                                <div>
                        </form>
                        <form action="/bookdetail/commentSave" method="POST">
                            @csrf
                            <table>
                                @if ($errors->has('comment'))
                                <div class="alert-danger">{{$errors->first('comment')}}</div>
                                @endif
                                <tr>
                                    <td>
                                        <textarea cols="80" rows="5" placeholder="コメント" name="comment">{{ old('comment') }}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="hidden" name="book_id" value="{{$book_id}}">
                                        <input type="submit" class="btn btn-outline-secondary w-100" value="コメント送信">
                                    </td>
                                </tr>
                            </table>
                        </form>
                        @if($display_flg == 'RENTAL_START_BUTTON')
                        <a class="btn btn-outline-secondary w-100" href="{{ route('rentalOffer',['book_id'=> $books->book_id]) }}">レンタル申し込み</a>
                        @elseif($display_flg == 'RENTAL_END_BUTTON')
                        <a class="btn btn-outline-secondary w-100" href="{{ route('rentalFinish',['book_id'=> $books->book_id]) }}">レンタル終了</a>
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