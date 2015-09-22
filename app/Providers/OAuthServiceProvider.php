<?php

namespace App\Providers;

use Dingo\Api\Auth\Provider\OAuth2;
use Illuminate\Support\ServiceProvider;

class OAuthServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->app[Auth::class]->extend('oauth', function ($app) {
            $provider = new OAuth2($app['oauth2-server.authorizer']->getChecker());

            $provider->setUserResolver(function ($id) {
                // Logic to return a user by their ID.
            });

            $provider->setClientResolver(function ($id) {
                // Logic to return a client by their ID.
            });

            return $provider;
        });
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        //
    }
}
