<?php

namespace PHPHub\Transformers;

use PHPHub\Transformers\Traits\HelpersTrait;
use PHPHub\User;
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
        $user = array_only($model->toArray(), User::$includable);

        if ($model->getAttribute('avatar')) {
            $user['avatar'] = $model->avatar();
        }

        if ($model->getAttribute('links')) {
            $user['links'] = [
                'replies_web_view' => route('users.replies.web_view', $model->id),
            ];
        }

        return $user;
    }
}
