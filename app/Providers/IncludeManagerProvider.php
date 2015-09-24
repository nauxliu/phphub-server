<?php

namespace PHPHub\Providers;

use Illuminate\Support\ServiceProvider;
use PHPHub\Transformers\IncludeManager\IncludeManager;

class IncludeManagerProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        app()->singleton(IncludeManager::class, function ($app){
            return new IncludeManager();
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
