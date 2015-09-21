<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class LocalProvidersRegister extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $app = app();
        if($app->environment('local')){
            $app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }
}
