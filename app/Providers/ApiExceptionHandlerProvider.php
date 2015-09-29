<?php

namespace PHPHub\Providers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ApiExceptionHandlerProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $handler = app('api.exception');
        $handler->register(function (ModelNotFoundException $exception) {
            throw new NotFoundHttpException;
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
