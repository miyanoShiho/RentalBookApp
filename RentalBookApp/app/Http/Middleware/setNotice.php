<?php

namespace App\Http\Middleware;

use Closure;
use App\Notice;
use App\Book;
use Illuminate\Http\Request;
use Illuminate\View\Factory;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
            // 一週間以内のお知らせ情報を取得 かつ　図書情報が存在するもの
            $date = Carbon::now()->subDay(7);
            $notices = Notice::userIdEqual($user_id)->dispDateEqual($date)
                ->whereExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('books')
                        ->whereRaw('notices.book_id = book_id');
                })->get();

            //    お知らせの時間表示
            // 　　前提：1週間前までしか表示しない
            $now = Carbon::now();
            $daysago = array();
            $i = 0;
            foreach ($notices as $notice) {
                $carbon = Carbon::parse($notice->created_at);
                $diff = $now->diffInDays($carbon);
                // 7日以内で1日以上の場合　n日前(7日単位)
                if ($diff > 0) {
                    $daysago[$i] = " " . $diff . "日前";
                } else {
                    $diffHours = $carbon->diffInHours($now);
                    if ($diffHours <= 1) {
                        // 1時間以内
                        $daysago[$i] = " 1時間以内";
                    } else {
                        // n時間前(24時間単位)
                        $daysago[$i] = " " . $diffHours . "時間前";
                    }
                }
                $i++;
            }
            $this->viewFactory->share('notices', $notices);
            $this->viewFactory->share('daysago', $daysago);
        }

        return $next($request);
    }
}
