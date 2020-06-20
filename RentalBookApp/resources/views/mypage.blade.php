<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('common')
    <title>マイページ</title>
</head>

<body>
    @include('header')
    <div class="title m-b-md">
        マイページ
    </div>
    <div class="jumbotron">
        <table>
            <tr>
                <td>
                    <a href="{{ route('selectMybookList') }}" class="btn btn-outline-secondary mypage-menu">
                        {{ __('マイブック') }}

                </td>
            </tr>
            <tr>
                <td>
                    <a href="{{ route('selectGivebookList') }}" class="btn btn-outline-secondary mypage-menu">
                        {{ __('貸している本') }}</td>
            </tr>
            <tr>
                <td>
                    <a href="{{ route('selectTakebookList') }}" class="btn btn-outline-secondary mypage-menu">
                        {{ __('借りている本') }}</td>
            </tr>
            <tr>
                <td>
                    <a href="{{ route('bookUpload') }}" class="btn btn-outline-secondary mypage-menu">
                        {{ __('アップロード') }}</td>
            </tr>
        </table>
        @foreach($books as $book)
        <div class="container">
            <table　class="container bg-success"　style="padding:30px;margin:30px;width:768px">
                <tr>
                    <div style="margin:30px">
                        <img src="{{$book->book_image_path}}" width="300" height="300">
                        <div class="float-right">
                            <h4 width="200px">{{$book->title}}</h4>
                            <button type="submit" class="btn bg-secondary">
                                {{ __('編集') }}
                            </button>
                            <button type="submit" class="btn bg-danger">
                                {{ __('削除') }}
                            </button>
                        </div>
                    </div>
                </tr>
            </table>
        </div>
        @endforeach
        <div>
</body>

</html>