<?php

namespace PHPHub\Providers;

use PHPHub\Repositories\Eloquent\LaunchScreenAdvertRepository;
use PHPHub\Repositories\Eloquent\NodeRepository;
use PHPHub\Repositories\Eloquent\NotificationRepository;
use PHPHub\Repositories\Eloquent\ReplyRepository;
use PHPHub\Repositories\Eloquent\TopicRepository;
use PHPHub\Repositories\Eloquent\UserRepository;
use PHPHub\Repositories\LaunchScreenAdvertRepositoryInterface;
use PHPHub\Repositories\NodeRepositoryInterface;
use PHPHub\Repositories\NotificationRepositoryInterface;
use PHPHub\Repositories\ReplyRepositoryInterface;
use PHPHub\Repositories\TopicRepositoryInterface;
use PHPHub\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        app()->bind(UserRepositoryInterface::class, UserRepository::class);
        app()->bind(TopicRepositoryInterface::class, TopicRepository::class);
        app()->bind(ReplyRepositoryInterface::class, ReplyRepository::class);
        app()->bind(NodeRepositoryInterface::class, NodeRepository::class);
        app()->bind(LaunchScreenAdvertRepositoryInterface::class, LaunchScreenAdvertRepository::class);
        app()->bind(NotificationRepositoryInterface::class, NotificationRepository::class);
    }
}
