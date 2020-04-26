       <div class="flex-center position-ref">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                        <a href="{{ url('/home') }}">マイページ</a>
                        <a href="{{ url('/home') }}">お知らせ</a>
                    @else
                        <a href="{{ route('login') }}">ログイン</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">新規登録</a>
                        @endif
                    @endauth
                    @if (session('status'))
                    <a href="{{ url('/home') }}">{{ session('status') }}</a>   
                    @endif
                </div>
            @endif
       </div>

