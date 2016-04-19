<?php
namespace Mapil\Auth;

use Illuminate\Auth\TokenGuard as LaravelTokenGuard;

class TokenGuard extends LaravelTokenGuard
{
    /**
     * Create a new authentication guard.
     *
     * @param  \Illuminate\Contracts\Auth\UserProvider  $provider
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function __construct(UserProvider $provider, Request $request)
    {
        $this->request = $request;
        $this->provider = $provider;
        $this->inputKey = 'api_token';
        $this->storageKey = 'secret';
    }
}