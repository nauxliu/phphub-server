<?php

namespace App\Transformers;

use App\Transformers\Traits\HelpersTrait;
use League\Fractal\TransformerAbstract;
use App\Models\Reply;

/**
 * Class ReplyTransformer
 * @package namespace App\Transformers;
 */
class ReplyTransformer extends TransformerAbstract
{
    use HelpersTrait;
    /**
     * Transform the \Reply entity
     * @param \Reply $model
     *
     * @return array
     */
    public function transformData(Reply $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
