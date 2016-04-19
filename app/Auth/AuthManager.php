<?php

namespace Mapil\Auth;

use Illuminate\Auth\AuthManager as LaravelAuthManager;

class AuthManager extends LaravelAuthManager
{
    /**
     * Create a token based authentication guard.
     *
     * @param  string  $name
     * @param  array  $config
     * @return \Illuminate\Auth\TokenGuard
     */
    public function createTokenDriver($name, $config)
    {
        // The token guard implements a basic API token based guard implementation
        // that takes an API token field from the request and matches it to the
        // user in the database or another persistence layer where users are.
        $guard = new TokenGuard(
            $this->createUserProvider($config['provider']),
            $this->app['request']
        );

        $this->app->refresh('request', $guard, 'setRequest');

        return $guard;
    }
}