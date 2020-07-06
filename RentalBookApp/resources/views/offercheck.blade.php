@extends('layouts.app')

@section('cssconf')
<link href="{{ asset('css/.css') }}" rel="stylesheet">

@section('content')
    <div class=row>
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            <div>
                <span class="h3">タイトル　：{{$title}}</span>
            </div>
            <div>
                <span class="h3">ユーザー名：{{$offer_user_name}}</span>
            </div>
            <div class="button-group">
                <button type="button" onclick="location.href='{{ route('bookdetail', ['book_id' => $book_id])}}'" class="btn btn-danger rounded-pill">キャンセル</button>
                <form action="/rentalOffer/offerCheck" method="post" id="offerForm"　style="display: inline">
                    @csrf
                    <input type="hidden" name="hidBookId" value="{{$book_id}}">
                    <input type="hidden" name="hidTitle" value="{{$title}}">
                    <input type="hidden" name="hidUserName" value="{{$offer_user_name}}">
                    <button type="submit" class="btn btn-primary rounded-pill">確定</button>
                </form>
                
            </div>
        </div>
        <div class="col-md-4">
        </div>
    </div>
@endsection

@section('jsconf')
<script src="{{ asset('/js/common.js') }}"></script>
@endsection

