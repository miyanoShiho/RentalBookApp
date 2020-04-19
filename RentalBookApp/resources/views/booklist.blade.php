<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>図書一覧画面</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!-- Styles -->
        <link href="{{ asset('css/common.css') }}" rel="stylesheet">
    </head>
    <body>
        @include('header')
        <div class="title m-b-md">
            図書一覧画面
            </div>
        <div class="d-flex">
        @for($i = 1;$i < 5;$i++)
            <img src="/storage/kimetu18.jpg" width="300" height="300">
        @endfor
        </div>
        <h4 >鬼滅の刃18巻</h4>
            <p >rentalTest</p>
            <a href="{{ url('bookdetail') }}">詳細を見る</a> 
    </body>
</html>
