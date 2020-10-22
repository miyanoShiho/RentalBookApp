<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('pageTitle')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Favicon -->
    <link rel="shortcut icon" href="/storage/bookmeet.png">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/common.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('cssconf')
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md shadow-sm header-color">
            <div class="container">
                <a class="navbar-brand header-font" href="{{ url('/') }}">
                    <img class="topimage" src="/storage/bookmeet_white.png">
                    {{ config('app.name', 'BookMe') }}
                </a>
                <button class="navbar-toggler border border-white" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link ml-3" href="{{ route('login') }}">{{ __('ログイン') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link ml-3" href="{{ route('register') }}">{{ __('新規登録') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle ml-3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ __('お知らせ') }} <span class="caret"></span>
                            </a>
                            @isset($notices)
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @php
                                $i = 0;
                                @endphp
                                @foreach($notices as $notice)
                                @if($notice->new_flag == '1')
                                <a class="dropdown-item" href="{{ route('updateNewFlg',['book_id'=> $notice->book_id,'notice_id'=> $notice->notice_id]) }}">
                                    @else
                                    <a class="dropdown-item" href="{{ route('bookdetail',['book_id'=> $notice->book_id]) }}">
                                        @endif
                                        {{ __($notice->body.' '.$daysago[$i]) }}
                                    </a>
                                    @php
                                    $i++;
                                    @endphp
                                    @endforeach
                            </div>
                            @endisset
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ml-3" href="{{ route('mypage') }}">{{ __('マイページ') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ml-3" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('ログアウト') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container-fluid">
            @yield('content')
            </div>
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
    @yield('jsconf')

</body>

</html>