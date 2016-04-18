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
        return Auth::guard('api')->onceBasic() ?: $next($request);
    }

}