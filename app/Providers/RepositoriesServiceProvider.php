<?php

namespace App\Providers;

use App\Repositories\Eloquent\ReplyRepository;
use App\Repositories\Eloquent\TopicRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\ReplyRepositoryInterface;
use App\Repositories\TopicRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        app()->bind(UserRepositoryInterface::class, UserRepository::class);
        app()->bind(TopicRepositoryInterface::class, TopicRepository::class);
        app()->bind(ReplyRepositoryInterface::class, ReplyRepository::class);
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
