<?php

namespace PHPHub\Listeners;

use JPush\Exception\APIRequestException;
use PHPHub\Events\Event;
use PHPHub\Events\NewReply;
use PHPHub\Events\TopicUpVoted;
use PHPHub\Repositories\NotificationRepositoryInterface;
use PHPHub\Services\PushService\Jpush;

class NotificationListener
{
    /**
     * Jpush 对象
     *
     * @var Jpush
     */
    private $jpush = null;

    /**
     * @var NotificationRepositoryInterface
     */
    private $notifications;

    /**
     * PushNotificationHandler constructor.
     *
     * @param NotificationRepositoryInterface $notifications
     */
    public function __construct(NotificationRepositoryInterface $notifications)
    {
        $this->notifications = $notifications;
    }

    /**
     * 推送消息.
     *
     * @param $user_ids
     * @param $msg
     * @param $extras
     */
    protected function push($user_ids, $msg, $extras = null)
    {
        if (! $this->jpush) {
            $this->jpush = new Jpush();
        }

        $user_ids = (array) $user_ids;
        $user_ids = array_map(function ($user_id) {
            return 'userid_'.$user_id;
        }, $user_ids);

        try {
            $this->jpush
                ->platform('all')
                ->message($msg)
                ->toAlias($user_ids)
                ->extras($extras)
                ->send();
        } catch (APIRequestException $e) {
            // Ignore
        }
    }

    /**
     * Handle the event.
     *
     * @param Event|TopicUpVoted $event
     */
    public function handle(Event $event)
    {
        $data = [
            'topic_id'     => $event->getTopicId(),
            'body'         => $event->getBody(),
            'from_user_id' => $event->getFromUserId(),
            'user_id'      => $event->getUserId(),
            'type'         => $event->getType(),
            'reply_id'     => $event->getReplyId(),
        ];

        $notification = $this->notifications->store($data);

        $presenter = app('autopresenter')->decorate($notification);

        $push_data = array_only($data, [
            'topic_id',
            'from_user_id',
            'type',
        ]);

        if ($data['reply_id'] !== 0) {
            $push_data['reply_id'] = $data['reply_id'];
            $push_data['replies_url'] = route('replies.web_view', $data['topic_id']);
        }

        $this->push($event->getUserId(), $presenter->message(), $push_data);
    }

    /**
     * 注册监听器给订阅者。.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(TopicUpVoted::class, class_callback(self::class, 'handle'));
        $events->listen(NewReply::class, class_callback(self::class, 'handle'));
    }
}
