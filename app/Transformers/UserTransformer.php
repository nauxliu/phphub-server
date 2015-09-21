<?php

namespace App\Transformers;

use App\Transformers\Traits\HelpersTrait;
use League\Fractal\TransformerAbstract;
use App\Models\User;

/**
 * Class UserTransformer
 * @package namespace App\Transformers;
 */
class UserTransformer extends TransformerAbstract
{
    use HelpersTrait;
    /**
     * Transform the \User entity
     * @param \User $model
     *
     * @return array
     */
    public function transformData(User $model)
    {
        return [
            'id'         => (int) $model->id,
            'name'       => $model->name,
            'avatar'     => $model->avatar,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at,
        ];
    }
}
