<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('common')
    <title>図書詳細画面</title>
</head>

<body>
    @include('header')
    <div class="title m-b-md">
        図書詳細画面
    </div>
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
                                    <label>ユーザー名：{{ __(Auth::user()->name) }}</label></td>
                            </tr>

                            <tr>
                                <td>
                                    @foreach($comments as $comment)
                                    <label>{{$comment->name}}</label>
                                    <br>
                                    <label>{{ $comment->body }}</label>
                                    <hr>
                                    @endforeach
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <input type="text" style="width:90%" value="コメント">
                                    <input type="submit" style="color:#ffffff;background-color:#0000ff;" value="確定"></td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" class="btn btn-outline-secondary" style="width:100%" value="レンタル申し込み">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" class="btn btn-outline-secondary" style="width:100%" value="レンタル終了">
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="{{ url('/home') }}">借りる</a>
</body>

</html>