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
                                <label>ユーザー名：{{ __($books->user->name) }}</label></td>
                        </tr>
                    </table>
                    <form action="/bookdetail/commentDelete" method="POST">
                        @csrf
                        <table width="100%">
                            @foreach($comments as $comment)
                            <tr>
                                <td><label>{{$comment->user->name}}</label></td>
                            </tr>
                            <tr>
                                <td><label>{{$comment->body}}</label></td>
                            </tr>
                            <tr>
                                <input type="hidden" name="comment_id" value="{{$comment->comment_id}}">
                                <input type="hidden" name="book_id" value="{{$bookId}}">
                                <td>
                                    <input type="submit" class="float-right" name="delete" onClick="delete_alert(event);return false;" value="削除">
                                    <hr>
                                </td>
                            </tr>
                            @endforeach
                        </table>
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
                                    <input type="hidden" name="book_id" value="{{$bookId}}">
                                    <input type="submit" class="btn btn-outline-secondary" style="width:100%" value="コメント送信">
                                </td>
                            </tr>
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('jsconf')
<script src="{{ asset('/js/common.js') }}"></script>
@endsection