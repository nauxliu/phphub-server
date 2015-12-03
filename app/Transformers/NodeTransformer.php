<?php

namespace PHPHub\Transformers;

/**
 * Class NodeTransformer.
 */
class NodeTransformer extends BaseTransformer
{
    /**
     * Transform the \Node entity.
     *
     * @param \Node $model
     *
     * @return array
     */
    public function transformData($model)
    {
        $data = $model->toArray();
        $data['parent_node'] = $model->parent_node ?: 0;

        return $data;
    }
}
