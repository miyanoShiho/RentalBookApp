<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SessionCheckMiddleware
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
        $user =  Auth::user();
        //Remember me でログインされた場合、sessionを設定し直す
        if ($user) {
            if(!$request->session()->get('user_id')){
                session(['user_id' => $user->id, 'user_name' => $user->name]);
            }
        } else {
            //エラーページを表示
            abort(403, 'Fail to authorize');
        }
        
        return $next($request);
    }
}
