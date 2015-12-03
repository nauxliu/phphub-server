<?php

/**
 * Created by PhpStorm.
 * User: xuan
 * Date: 10/17/15
 * Time: 4:36 PM.
 */
namespace PHPHub\Events;

use PHPHub\Reply;
use PHPHub\Topic;

/**
 * Class ShouldNotifyTrait.
 *
 * @method getBody
 * @method getUserId
 * @method getTopicId
 * @method getFromUserId
 * @method getType
 */
trait ShouldNotifyTrait
{
    protected $body = null;
    protected $topic_id = null;
    protected $reply_id = 0;
    protected $user_id = null;
    protected $from_user_id = null;
    protected $type = null;

    public function getReplyId()
    {
        return $this->reply_id ?: 0;
    }

    public function __call($method, $args)
    {
        $property = snake_case(str_replace('get', '', $method));
        if (! isset($this->$property) || $this->$property === null) {
            throw new \Exception('请在 Event 中设置 '.$property);
        }

        return $this->$property;
    }

    /**
     * 设置 Notification Type.
     *
     * @param $type
     */
    public function setNotificationType($type)
    {
        $this->type = $type;
    }

    /**
     * 从 Topic 对象初始化通知信息.
     *
     * @param Topic $topic
     * @param $from_user_id
     */
    public function setNotificationInfoFromTopic(Topic $topic, $from_user_id)
    {
        $this->body = $topic->body;
        $this->topic_id = $topic->id;
        $this->user_id = $topic->user_id;
        $this->from_user_id = $from_user_id;

        if (isset($this->notification_type)) {
            $this->type = $this->type ?: $this->notification_type;
        }
    }

    /**
     * 从 Reply 对象初始化通知信息.
     *
     * @param Reply $reply
     * @param $from_user_id
     * @param null $user_id
     */
    public function setNotificationInfoFromReply(Reply $reply, $from_user_id, $user_id = null)
    {
        $this->body = $reply->body;
        $this->topic_id = $reply->topic_id;
        $this->reply_id = $reply->id;
        $this->user_id = $user_id ?: $reply->topic()->pluck('user_id');
        $this->from_user_id = $from_user_id;

        if (isset($this->notification_type)) {
            $this->type = $this->type ?: $this->notification_type;
        }
    }
}
