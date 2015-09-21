<?php

namespace App\Providers;

use App\Repositories\Eloquent\ReplyRepositoryEloquent;
use App\Repositories\Eloquent\TopicRepositoryEloquent;
use App\Repositories\Eloquent\UserRepositoryEloquent;
use App\Repositories\ReplyRepository;
use App\Repositories\TopicRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        app()->bind(UserRepository::class, UserRepositoryEloquent::class);
        app()->bind(TopicRepository::class, TopicRepositoryEloquent::class);
        app()->bind(ReplyRepository::class, ReplyRepositoryEloquent::class);
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        //
    }
}
