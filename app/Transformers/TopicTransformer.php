<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Topic;

/**
 * Class TopicTransformer
 * @package namespace App\Transformers;
 */
class TopicTransformer extends TransformerAbstract
{

    /**
     * Transform the \Topic entity
     * @param Topic $model
     * @return array
     */
    public function transform(Topic $model)
    {
        return array_only([
            'id'         => (int) $model->id,
            'title'      => $model->title,
            'body'       => $model->body,
            'user_id'    => (int) $model->user_id,
            'node_id'    => (int) $model->node_id,
            'is_excellent' => (boolean) $model->is_excellent,
            'is_wiki' => (boolean) $model->is_wiki,
            'view_count' => (int) $model->view_count,
            'reply_count' => (int) $model->reply_count,
            'favorite_count' => (int) $model->favorite_count,
            'vote_count' => (int) $model->vote_count,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ], array_keys($model->toArray()));
    }
}
