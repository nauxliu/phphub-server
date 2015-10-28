<?php

namespace PHPHub\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    protected $controller_namespace = 'PHPHub\Http\Controllers';

    protected $api_controller_namespace = 'PHPHub\Http\ApiControllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param \Illuminate\Routing\Router $router
     */
    public function boot(Router $router)
    {
        //

        parent::boot($router);
    }

    /**
     * Define the routes for the application.
     *
     * @param \Illuminate\Routing\Router $router
     */
    public function map(Router $router)
    {
        $this->configureAPIRoute();

        $router->group(['namespace' => $this->controller_namespace], function ($router) {
            require app_path('Http/routes.php');
        });
    }

    /**
     * 配置 API 路由.
     */
    public function configureAPIRoute()
    {
        $api_router = app('Dingo\Api\Routing\Router');
        $api_router->group([
            'version'   => env('API_PREFIX'),
            'namespace' => $this->api_controller_namespace,
        ], function ($router) {
            require app_path('Http/api_routes.php');
        });
    }
}
