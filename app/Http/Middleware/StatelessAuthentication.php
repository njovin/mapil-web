<?php

namespace Mapil\Http\Middleware;

use Auth;
use Closure;

class StatelessAuthentication
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
        enable_query_log();
        $foo =  Auth::guard('api')->user() ?: $next($request);
        dump_query_log();
        die();
    }

}