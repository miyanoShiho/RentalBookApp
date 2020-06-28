@extends('layouts.app')

@section('cssconf')
<link href="{{ asset('css/.css') }}" rel="stylesheet">

@section('content')
    <div>
        <span>タイトル：<span>
    </div>
    <div>
        <span>ユーザー名：</span>
    </div>
    <h2>申し込み完了</h2>
@endsection

@section('jsconf')
<script src="{{ asset('/js/common.js') }}"></script>
@endsection

