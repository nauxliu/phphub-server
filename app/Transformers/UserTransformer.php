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
        $data           = array_only($model->toArray(), User::$includable);
        $data['avatar'] = $model->avatar();

        return $data;
    }
}
