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

            //    お知らせの時間表示について
            //    要件：
            // 　　前提：1週間前までしか表示しない仕様
            // 　　1時間以内
            // 　　n時間前(24時間単位)

            // 　　7日以内の場合　n日前(7日単位)
            $daysago = array();
            $i = 0;
            foreach ($notices as $notice) {

                $diff = $notice->created_at->diff(Carbon::now());

                if ($diff->days <= 7) {
                    $diff = $date->diff($notice->created_at);

                    $daysago[$i] = " " . $diff->days . "日前";
                    $i++;
                    //dd($daysago);
                }
            }


            $this->viewFactory->share('notices', $notices);
            $this->viewFactory->share('daysago', $daysago);

            //dd($notices);
        }

        return $next($request);
    }
}
