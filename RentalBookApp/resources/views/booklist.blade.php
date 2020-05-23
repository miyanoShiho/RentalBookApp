<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    @include('common')
    <title>図書一覧画面</title>
    <script>
$('.navbar-nav>li>a , .dropdown-menu>a').on('click', function(){
    if(this.id != 'navbarDropdown'){
      $('.navbar-collapse').collapse('hide');
    }
});
</script>
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
