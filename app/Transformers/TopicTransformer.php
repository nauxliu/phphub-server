<?php

namespace PHPHub\Transformers;

use PHPHub\Transformers\Traits\HelpersTrait;
use League\Fractal\TransformerAbstract;

/**
 * Class TopicTransformer.
 */
class TopicTransformer extends TransformerAbstract
{
    use HelpersTrait;

    /**
     * Resources that can be included if requested.
     *
     * @var array
     */
    protected $availableIncludes = array('user', 'last_reply_user', 'replies', 'node');

    /**
     * Include resources without needing it to be requested.
     *
     * @var array
     */
    protected $defaultIncludes = array();

    /**
     * Transform the \Topic entity.
     *
     * @param Topic $model
     *
     * @return array
     */
    public function transformData($model)
    {
        return [
            'id'             => (int) $model->id,
            'title'          => $model->title,
            'body'           => $model->body,
            'user_id'        => (int) $model->user_id,
            'node_id'        => (int) $model->node_id,
            'is_excellent'   => (boolean) $model->is_excellent,
            'is_wiki'        => (boolean) $model->is_wiki,
            'view_count'     => (int) $model->view_count,
            'reply_count'    => (int) $model->reply_count,
            'favorite_count' => (int) $model->favorite_count,
            'vote_count'     => (int) $model->vote_count,
            'created_at'     => $model->created_at,
            'updated_at'     => $model->updated_at,
        ];
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
