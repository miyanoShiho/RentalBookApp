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
            @yield('checkWords')
            @yield('underContent')
        </div>
        <div class="col-md-4">
        </div>
    </div>
@endsection

@section('jsconf')
<script src="{{ asset('/js/common.js') }}"></script>
@endsection

