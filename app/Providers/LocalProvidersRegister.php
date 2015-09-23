<?php

namespace PHPHub\Providers;

use Illuminate\Support\ServiceProvider;

class LocalProvidersRegister extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $app = app();
        if ($app->environment('local')) {
            $app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }
}
