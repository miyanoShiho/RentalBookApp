<?php

namespace App\Http\Middleware;

use Closure;
use App\Notice;
use Illuminate\Http\Request;
use Illuminate\View\Factory;

class setNotice
{

    public function __construct(Factory $viewFactory)
    {
        $this->viewFactory = $viewFactory;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // ログイン済みの場合、お知らせ情報を取得する
        if ($request->session()->exists('user_id')) {
            $user_id = $request->session()->get('user_id');
            $notices = Notice::userIdEqual($user_id)->get();
            $this->viewFactory->share('notices', $notices);
        }
        return $next($request);
    }
}
