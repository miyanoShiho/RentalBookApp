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
        <tr><td>
       <button type="submit" class="btn btn-outline-secondary mypage-menu">
                                    {{ __('マイブック') }}
                                </button></td></tr>
                                <tr><td>
        <button type="submit" class="btn btn-outline-secondary mypage-menu">
                                    {{ __('貸している本') }}
                                </button></td></tr>
                                <tr><td>
         <button type="submit" class="btn btn-outline-secondary mypage-menu">
                                    {{ __('借りている本') }}
                                </button></td></tr>
                                <tr><td>
        <button type="submit" class="btn btn-outline-secondary mypage-menu">
                                    {{ __('アップロード') }}
                                </button></td>
                                </tr>
</table>
        @for($i = 1;$i < 5;$i++)
        <div class="container">
        <table　class="container bg-success"　style="padding:30px;margin:30px;width:768px">
        <tr>
            <div style="margin:30px">
            <img src="/storage/kimetu18.jpg" width="300" height="300">
            <div class="float-right">
            <h4 width="200px">鬼滅の刃18巻</h4>
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
        @endfor
        <div>
    </body>
</html>
