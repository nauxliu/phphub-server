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
        return ['name' => ''];
    }
}
