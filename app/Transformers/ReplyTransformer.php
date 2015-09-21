<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Reply;

/**
 * Class ReplyTransformer
 * @package namespace App\Transformers;
 */
class ReplyTransformer extends TransformerAbstract
{

    /**
     * Transform the \Reply entity
     * @param \Reply $model
     *
     * @return array
     */
    public function transform(Reply $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
