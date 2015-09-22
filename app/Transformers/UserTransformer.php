<?php

namespace App\Transformers;

use App\Transformers\Traits\HelpersTrait;
use App\User;
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
        $data = array_only($model->toArray(), User::$includable);
        $data['avatar'] = $model->avatar();
        return $data;
    }
}
