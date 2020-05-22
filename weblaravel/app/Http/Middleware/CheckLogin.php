<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin {
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request 用于获取客户端请求的请求数据类
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $params = null) {

        #dump($params);

        // 判断用户是否已经登录
        if (!session()->has('user')) {
            return redirect(route('login'));
        }


        // 向下执行
        return $next($request);
    }
}
