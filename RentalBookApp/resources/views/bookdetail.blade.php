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
        <div class="d-flex">
            <img src="/storage/kimetu18.jpg" width="300" height="300">
        </div>
        <h4 >鬼滅の刃18巻</h4>
            <p >rentalTest</p>
            <a href="{{ url('/home') }}">借りる</a>
    </body>
</html>
