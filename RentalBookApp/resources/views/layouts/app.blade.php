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
    <link rel="shortcut icon" href="storage/bookmeet.png">
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
        <nav class="navbar navbar-expand flex-column flex-md-row shadow-sm header-color">
            <!-- Left Side Of Navbar -->
            <a class="navbar-brand header-font ml-5" href="{{ url('/') }}">
                <img class="topimage" src="storage/bookmeet_white.png">
                {{ config('app.name', 'BookMe') }}
            </a>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-md-auto mr-5">
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
        </nav>

        <main class="py-4">
            <div class="container-fluid">
            @yield('content')
            </div>
        </main>
    </div>

    @yield('jsconf')

</body>

</html>