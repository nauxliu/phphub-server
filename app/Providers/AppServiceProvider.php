<?php

namespace PHPHub\Providers;

use Illuminate\Support\ServiceProvider;
use Naux\AutoCorrect;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     */
    public function register()
    {
         $this->app->singleton('auto-correct', function(){
             return new AutoCorrect;
         });
    }
}
