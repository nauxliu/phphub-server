<?php

namespace PHPHub\Events;

use Illuminate\Queue\SerializesModels;
use PHPHub\Reply;

class NewReply extends Event
{
    use SerializesModels, ShouldNotifyTrait;

    /**
     * 设置生成的通知类型.
     *
     * @var string
     */
    protected $notification_type = 'new_reply';

    /**
     * Create a new event instance.
     *
     * @param Reply $reply
     * @param $from_user
     * @param $user_id
     */
    public function __construct(Reply $reply, $from_user, $user_id)
    {
        $this->setNotificationInfoFromReply($reply, $from_user, $user_id);
    }
}
