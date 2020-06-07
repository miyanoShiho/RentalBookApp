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
        <div class="d-flex row">
        @for($i = 1;$i < 5;$i++)
            <div class="col-4 col-md-3">
                <img src="/storage/kimetu18.jpg" class="w-100">
                <div class="">
                    <span>タイトル</span>
                </div>
                <div class="">
                    <span>ユーザー名</span>
                </div>
                <div class="">
                    <span>レンタル可</span>
                </div>
            </div>
        @endfor
        </div>
        <h4 >鬼滅の刃18巻</h4>
    </body>
</html>
