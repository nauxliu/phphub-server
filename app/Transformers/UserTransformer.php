<?php

namespace App\Transformers;

use App\Transformers\Traits\HelpersTrait;
use League\Fractal\TransformerAbstract;

/**
 * Class UserTransformer.
 */
class UserTransformer extends TransformerAbstract
{
    use HelpersTrait;
    /**
     * Transform the \User entity.
     *
     * @param \User $model
     *
     * @return array
     */
    public function transformData($model)
    {
        return [
            'id'                 => (int) $model->id,
            'name'               => $model->name,
            'avatar'             => $model->avatar,
            'github_id'          => (int) $model->github_id,
            'topic_count'        => (int) $model->topic_count,
            'reply_count'        => (int) $model->reply_count,
            'notification_count' => (int) $model->notification_count,
            'is_banned'          => (boolean) $model->is_banned,
            'twitter_account'    => $model->twitter_account,
            'company'            => $model->company,
            'city'               => $model->city,
            'email'              => $model->email,
            'signature'          => $model->signature,
            'introduction'       => $model->introduction,
            'github_name'        => $model->github_name,
            'real_name'          => $model->real_name,
            'created_at'         => $model->created_at,
            'updated_at'         => $model->updated_at,
        ];
    }
}
