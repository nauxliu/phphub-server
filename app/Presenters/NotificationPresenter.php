<?php

namespace PHPHub\Presenters;

use McCool\LaravelAutoPresenter\BasePresenter;

/**
 * Class NotificationPresenter.
 */
class NotificationPresenter extends BasePresenter
{
    /**
     * 通知类型对应的消息.
     *
     * @var array
     */
    protected $type_messages =
        [
            'new_reply'            => 'Your topic have new reply',
            'attention'            => 'Attented topic has new reply',
            'at'                   => 'Mention you At',
            'topic_favorite'       => 'Favorited your topic',
            'topic_attent'         => 'Attented your topic',
            'topic_upvote'         => 'Up Vote your topic',
            'reply_upvote'         => 'Up Vote your reply',
            'topic_mark_wiki'      => 'has mark your topic as wiki',
            'topic_mark_excellent' => 'has recomended your topic',
            'comment_append'       => 'Commented topic has new update',
            'attention_append'     => 'Attented topic has new update',
        ];

    /**
     * 解析通知类型对应的消息.
     *
     * @return string
     *
     * @throws \Exception
     */
    public function typeMessage()
    {
        if (! array_key_exists($this->wrappedObject->type, $this->type_messages)) {
            throw new \Exception('Type '.$this->wrappedObject->type.'not exists');
        }

        return trans('notification.'.$this->type_messages[$this->wrappedObject->type]);
    }

    /**
     * 拼装完整通知消息.
     *
     * @return string
     *
     * @throws \Exception
     */
    public function message()
    {
        return $this->wrappedObject->fromUser->name
        .' • '.$this->typeMessage()
        .' • '.$this->wrappedObject->topic->title;
    }
}
