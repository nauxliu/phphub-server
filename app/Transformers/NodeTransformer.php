<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Node;

/**
 * Class NodeTransformer.
 */
class NodeTransformer extends TransformerAbstract
{
    /**
     * Transform the \Node entity.
     *
     * @param \Node $model
     *
     * @return array
     */
    public function transform(Node $model)
    {
        return [
            'id'   => (int) $model->id,
            'name' => $model->name,
        ];
    }
}
