<?php

namespace App\Http\Middleware;

use Closure;

class EchoTest
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
        // echo auth()->id();
        // abort_if(true, 403, '訊息');
        // if (auth()->id() !== 1) {
        //     echo '不是1';
        // }
        return $next($request);
    }
}
