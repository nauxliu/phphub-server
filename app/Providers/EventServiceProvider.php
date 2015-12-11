<?php

namespace PHPHub\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use PHPHub\Listeners\NotificationListener;
use PHPHub\Listeners\TopicListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'PHPHub\Events\SomeEvent' => [
            'PHPHub\Listeners\EventListener',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param \Illuminate\Contracts\Events\Dispatcher $events
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        if (! \Request::isMethod('GET')) {
            $events->subscribe(NotificationListener::class);
            $events->subscribe(TopicListener::class);
        }
    }
}
