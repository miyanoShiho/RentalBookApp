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
    <button type="button" class="btn btn-danger rounded-pill">キャンセル</button>
    <button type="button" class="btn btn-primary rounded-pill">確認</button>
@endsection

@section('jsconf')
<script src="{{ asset('/js/common.js') }}"></script>
@endsection

