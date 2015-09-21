<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    protected $controller_namespace = 'App\Http\Controllers';

    protected $api_controller_namespace = 'App\Http\ApiControllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot(Router $router)
    {
        //

        parent::boot($router);
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->controller_namespace], function ($router) {
            require app_path('Http/routes.php');
        });

        $api_router = app('Dingo\Api\Routing\Router');
        $api_router->group(['version' => 'v1', 'namespace' => $this->api_controller_namespace], function ($router) {
            require app_path('Http/api_routes.php');
        });
    }
}
