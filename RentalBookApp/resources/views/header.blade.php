       <div class="flex-center position-ref">
            @if (Route::has('login'))
                <div class="top-right links">
                    <ul>
                    <li>
                    <a href="{{ url('/') }}">Home</a>
                    </li>
                    @auth
                    <li>
                        <a href="{{ url('/mypage') }}">マイページ</a>
                    </li>
                    <li style="margin-top:-10px">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ __('お知らせ') }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('bookdetail') }}">
                                        {{ __('太郎が書籍「books」をレンタルしました') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('bookdetail') }}">
                                        <b style="color:red">{{ __('NEW') }}</b>{{ __(' 次郎が書籍「books2」をレンタルしました') }}
                                    </a>
                                </div>
                    </li>
                    @else
                    <li>
                        <a href="{{ route('login') }}">ログイン</a>
                    </li>
                        @if (Route::has('register'))
                        <li>
                            <a href="{{ route('register') }}">新規登録</a>
                     </li>
                        @endif
                    @endauth
                    @if (session('status'))
                    <a href="{{ url('/home') }}">{{ session('status') }}</a>
                    @endif
                </div>
            @endif
       </div>
