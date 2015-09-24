<?php

namespace PHPHub\Providers;

use PHPHub\Repositories\Eloquent\NotificationRepository;
use PHPHub\Repositories\Eloquent\ReplyRepository;
use PHPHub\Repositories\Eloquent\TopicRepository;
use PHPHub\Repositories\Eloquent\UserRepository;
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
        app()->bind(UserRepositoryInterface::class, UserRepository::class);
        app()->bind(TopicRepositoryInterface::class, TopicRepository::class);
        app()->bind(ReplyRepositoryInterface::class, ReplyRepository::class);
        app()->bind(NotificationRepositoryInterface::class, NotificationRepository::class);
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        //
    }
}
