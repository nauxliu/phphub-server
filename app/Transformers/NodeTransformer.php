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
        return $model->toArray();
    }
}
