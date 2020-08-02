@extends('layouts.app')

@section('pageTitle','マイページ')

@section('cssconf')
<link href="{{ asset('css/mypage.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="row">
    <div class="col-md-3 list-group">
        <a href="{{ route('mypage') }}" 　class="btn btn-outline-secondary">
            {{ __('マイブック') }}</a>
        <a href="{{ route('selectGivebookList') }}" class="btn btn-outline-secondary">
            {{ __('貸している本') }}</a>

        <a href="{{ route('selectTakebookList') }}" class="btn btn-outline-secondary">
            {{ __('借りている本') }}</a>

        <a href="{{ route('bookUpload') }}" class="btn btn-outline-secondary">
            {{ __('アップロード') }}</a>
    </div>
    <div class="col-md-9">
        @foreach($books as $book)
        <form action="/mypage/bookDelete" method="POST">
            @csrf
            <div class="container　mypage-wrapper">
                <div class="row">
                    <div class="container bg-success" style="padding:30px;margin:30px;width:768px">
                        <img src="{{$book->book_image_path}}" name="bookImagePath" width="300" height="300">
                        <div class="float-right">
                            <h4 width="200px">{{$book->title}}</h4>
                            @if ($book->rental_status == 0)
                            <a class="btn bg-secondary" href="{{ route('bookUpdate',['book_id'=> $book->book_id]) }}">
                                {{ __('編集') }}
                            </a>
                            <input type="hidden" name="hidBookId" value="{{$book->book_id}}">
                            <input type="submit" class="btn bg-danger" name="deleteButton" onClick="delete_alert(event);return false;" value="削除">
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </form>
        @endforeach
    </div>
    <div>
        @endsection
        @section('jsconf')
        <script src="{{ asset('/js/common.js') }}"></script>
        @endsection