<?php

namespace PHPHub\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \PHPHub\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \LucaDegasperi\OAuth2Server\Middleware\OAuthExceptionHandlerMiddleware::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'csrf'                       => \PHPHub\Http\Middleware\VerifyCsrfToken::class,
        'auth'                       => \PHPHub\Http\Middleware\Authenticate::class,
        'auth.basic'                 => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest'                      => \PHPHub\Http\Middleware\RedirectIfAuthenticated::class,
        'oauth'                      => \LucaDegasperi\OAuth2Server\Middleware\OAuthMiddleware::class,
        'oauth-user'                 => \LucaDegasperi\OAuth2Server\Middleware\OAuthUserOwnerMiddleware::class,
        'oauth-client'               => \LucaDegasperi\OAuth2Server\Middleware\OAuthClientOwnerMiddleware::class,
        'check-authorization-params' => \LucaDegasperi\OAuth2Server\Middleware\CheckAuthCodeRequestMiddleware::class,
        'api.throttle'               => \Dingo\Api\Http\Middleware\RateLimit::class,
    ];
}
