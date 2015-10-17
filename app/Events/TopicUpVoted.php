<?php

namespace PHPHub\Events;

use Illuminate\Queue\SerializesModels;
use PHPHub\Topic;

class TopicUpVoted extends Event
{
    use SerializesModels, ShouldNotifyTrait;

    /**
     * 设置生成的通知类型.
     *
     * @var string
     */
    protected $notification_type = 'topic_upvote';

    /**
     * Create a new event instance.
     *
     * @param Topic $topic 被赞用户
     * @param $by_user int 点赞用户
     */
    public function __construct(Topic $topic, $by_user)
    {
        $this->setNotificationInfoFromTopic($topic, $by_user);
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
