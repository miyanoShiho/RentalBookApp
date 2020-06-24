<?php

namespace App\Http\Middleware;

use Closure;
use App\Notice;
use Illuminate\Http\Request;

class HeaderMiddleware
{
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
            $userId = $request->session()->get('user_id');
            $notices = Notice::userIdEqual($userId)->get();
            session(['notices' => $notices]);
        }
        return $next($request);
    }
}
