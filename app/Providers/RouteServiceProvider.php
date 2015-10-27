<?php

namespace PHPHub\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Request;

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
        // 如果访问的域名是 API_DOMAIN 配置项的，就只注册 API 路由
        // 如果访问的域名是其他域名，则将先所有路由加上前缀 /api 后注册。
        if (str_contains(Request::root(), config('api.domain'))) {
            $api_router = app('Dingo\Api\Routing\Router');
            $api_router->group([
                'version'    => config('api.version'),
                'prefix'     => config('api.version'),
                'namespace'  => $this->api_controller_namespace,
                'middleware' => 'api.throttle',
                'limit'      => env('RATE_LIMITS'),
                'expires'    => env('RATE_LIMITS_EXPIRES'),
            ], function ($router) {
                require app_path('Http/api_routes.php');
            });
        } else {
            $router->group([
                'prefix'    => 'api/'.config('api.version'),
                'namespace' => 'PHPHub\Http\ApiControllers', ], function ($router) {
                require app_path('Http/api_routes.php');
            });

            $router->group(['namespace' => $this->controller_namespace], function ($router) {
                require app_path('Http/routes.php');
            });
        }
    }
}
