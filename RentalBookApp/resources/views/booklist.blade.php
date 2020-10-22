@extends('layouts.app')

@section('pageTitle','図書一覧')

@section('cssconf')
<link href="{{ asset('css/booklist.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="row no-gutters">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="container-fluid">
            <div class="d-flex row books-wrapper">
                @foreach($books as $book)
                <div class="col-4 col-md-3 book-wrapper">
                    <a href="{{ route('bookdetail', ['book_id' => $book->book_id]) }}">
                        <div class="card">
                            <img src="{{$book->book_image_path}}" class="w-100">
                            <div class="title">
                                {{$book->title}}
                            </div>
                            <div class="userName">
                                {{$book->user->name}}
                            </div>
                            @if(isset($book->rental_user_id))
                            <div class="rentalStatus disable">
                                レンタル不可
                            </div>
                            @else
                            <div class="rentalStatus enable">
                                レンタル可
                            </div>
                            @endif
                        </div>
                    </a>
                </div>
                @endforeach
            </div><!-- books-wrapper -->
        </div><!-- container-fluid -->
        {{$books->links()}}
    </div>
    <div class="col-md-1"></div>
</div>
@endsection

@section('jsconf')
<script src="{{ asset('/js/common.js') }}"></script>
@endsection

