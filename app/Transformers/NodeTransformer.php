<?php

namespace PHPHub\Transformers;

use League\Fractal\TransformerAbstract;
use PHPHub\Transformers\Traits\HelpersTrait;

/**
 * Class NodeTransformer.
 */
class NodeTransformer extends TransformerAbstract
{
    use HelpersTrait;

    /**
     * Transform the \Node entity.
     *
     * @param \Node $model
     *
     * @return array
     */
    public function transformData($model)
    {
        $data                = $model->toArray();
        $data['parent_node'] = $model->parent_node ?: 0;

        return $data;
    }
}
