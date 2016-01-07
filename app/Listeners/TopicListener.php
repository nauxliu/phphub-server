<?php

namespace PHPHub\Listeners;

use Auth;
use PHPHub\Events\Event;
use PHPHub\Topic;
use Purifier;

class TopicListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    public function onSaving(Topic $topic)
    {
        $topic->user_id = Auth::id();
        $topic->title = Purifier::clean($topic->title, 'title');
        $topic->body_original = Purifier::clean(trim($topic->body), 'body');
        $topic->body = app('markdown')->text($topic->body_original);
        $topic->excerpt = str_limit(trim(preg_replace('/\s+/', ' ', strip_tags($topic->body))), 200);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            eloquent_event(Topic::class, Event::SAVING),
            class_callback(self::class, 'onSaving')
        );
    }
}
