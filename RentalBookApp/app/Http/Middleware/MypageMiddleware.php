<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class MypageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // TODO：ログイン画面でセッションIDを設定するまでのモック
        $data = [
            ['userId' => Auth::id()]
        ];
        $request->merge(['data' => $data]);
        return $next($request);
        // TODO:$response->status()によるエラーハンドリング
    }
}
