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
     * @param \Topic $model
     *
     * @return array
     */
    public function transform(Topic $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
