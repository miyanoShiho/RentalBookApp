@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __($books->title) }}</div>

                <div class="card-body">
                    <table>
                        <tr>
                            <td>
                                <img src="{{ __($books->book_image_path) }}" width="300" height="300"></td>
                        </tr>
                        <tr>
                            <td>
                                <div style="padding: 10px; margin-bottom: 10px; border: 1px dotted #333333; border-radius: 5px; background-color: #ffff99;">
                                    貸出状況：{{ __($books->rental_status) }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <textarea cols="80" rows="5" placeholder="説明">{{ __($books->body) }}</textarea></td>
                        </tr>
                        <tr>
                            <td>
                                <label>ユーザー名：テスト</label></td>
                        </tr>

                        <tr>
                            <td>
                                @foreach($comments as $comment)
                                <label>{{$comment->name}}</label>
                                <br>
                                <label>{{ $comment->body }}</label>
                                <form action="/bookdetail/commentDelete" method="POST">
                                    @csrf
                                    <input type="hidden" name="comment_id" value="{{$comment->comment_id}}">
                                    <input type="submit" class="float-right" name="delete" onClick="delete_alert(event);return false;" value="削除">
                                </form>
                                <hr>
                                @endforeach
                            </td>
                        </tr>

                        <form action="/bookdetail/commentSave" method="POST">

                            @if ($errors->has('comment'))
                            <div class="alert-danger">{{$errors->first('comment')}}</div>
                            @endif
                            @csrf
                            <tr>
                                <td>
                                    <textarea cols="80" rows="5" placeholder="コメント" name="comment">{{ old('comment') }}</textarea>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <input type="hidden" name="book_id" value="1">
                                    <input type="submit" class="btn btn-outline-secondary" style="width:100%" value="コメント送信">
                                </td>
                            </tr>
                        </form>
                        @if($displayFlg == 'RENTAL_START_BUTTON')
                        <tr>
                            <td>
                                <input type="submit" class="btn btn-outline-secondary" style="width:100%" value="レンタル申し込み">
                            </td>
                        </tr>
                        @elseif($displayFlg == 'RENTAL_END_BUTTON')
                        <tr>
                            <td>
                                <input type="submit" class="btn btn-outline-secondary" style="width:100%" value="レンタル終了">
                            </td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('jsconf')
<script src="{{ asset('/js/common.js') }}"></script>
@endsection