@extends('layouts.app')

@section('cssconf')
<link href="{{ asset('css/rentalcheck.css') }}" rel="stylesheet">
@endsection


@section('content')
    <div class=row>
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <div class="title h3">タイトル　：{{$title}}</div>
            <div class="username h3">ユーザー名：{{$offer_user_name}}</div>
            @yield('checkWords')
            @yield('underContent')
        </div>
        <div class="col-md-3">
        </div>
    </div>
@endsection

@section('jsconf')
<script src="{{ asset('/js/common.js') }}"></script>
@endsection

