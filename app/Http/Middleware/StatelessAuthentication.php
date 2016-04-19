<?php

namespace Mapil\Http\Middleware;

use Auth;
use Closure;
use Mapil\Models\ApiCredential;

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
        $credential = ApiCredential::whereToken($request->getUser())->whereSecret($request->getPassword())->first();
        if(!$credential) {
            return response('Unauthorized.', 401);
        }
        Auth::login($credential);
        return $next($request);
    }

}