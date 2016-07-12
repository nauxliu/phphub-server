<?php

namespace PHPHub\Transformers;

/**
 * Class TopicTransformer.
 */
class TopicTransformer extends BaseTransformer
{
    /**
     * Resources that can be included if requested.
     *
     * @var array
     */
    protected $availableIncludes = ['user', 'last_reply_user', 'replies', 'node'];

    /**
     * Include resources without needing it to be requested.
     *
     * @var array
     */
    protected $defaultIncludes = [];

    /**
     * Transform the \Topic entity.
     *
     * @param Topic $model
     *
     * @return array
     */
    public function transformData($model)
    {
        $data = $model->toArray();
        $data['links'] = [
            'details_web_view' => route('topic.web_view', $model->id),
            'replies_web_view' => route('replies.web_view', $model->id),
            'web_url'          => trim(config('app.url'), '/').'/topics/'.$model->id,
        ];

        return $data;
    }

    public function includeUser($model)
    {
        return $this->item($model->user, new UserTransformer());
    }

    public function includeLastReplyUser($model)
    {
        return $this->item($model->lastReplyUser ?: $model->user, new UserTransformer());
    }

    public function includeReplies($model)
    {
        return $this->collection($model->replies, new ReplyTransformer());
    }

    public function includeNode($model)
    {
        return $this->item($model->node, new NodeTransformer());
    }
}
