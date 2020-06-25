@extends('layouts.app')

@section('cssconf')
<link href="{{ asset('css/booklist.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="d-flex row  books-wrapper">
            @foreach($books as $book)
            <div class="col-4 col-md-3 book-wrapper">
                <a href="{{ route('bookdetail', ['book_id' => $book->book_id]) }}">
                    <img src="{{$book->book_image_path}}" class="w-100">
                    <div class="title">
                        <span>{{$book->title}}</span>
                    </div>
                    <div class="userName">
                        <span>{{$book->user->name}}</span>
                    </div>
                    @if(isset($book->rental_user_id))
                    <div class="rentalStatus disable">
                        <span>レンタル不可</span>
                    </div>
                    @else
                    <div class="rentalStatus enable">
                        <span>レンタル可</span>
                    </div>
                    @endif
                </a>
            </div>
            @endforeach
        </div>
        {{$books->links()}}
    </div>
    <div class="col-md-1"></div>
</div>
@endsection

@section('jsconf')
<script src="{{ asset('/js/common.js') }}"></script>
@endsection

