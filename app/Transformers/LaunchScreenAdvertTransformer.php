<?php

namespace PHPHub\Transformers;

use League\Fractal\TransformerAbstract;
use PHPHub\Transformers\Traits\HelpersTrait;

/**
 * Class LaunchScreenAdvertTransformer.
 */
class LaunchScreenAdvertTransformer extends TransformerAbstract
{
    use HelpersTrait;

    /**
     * Transform the \LaunchScreenAdvert entity.
     *
     * @param $model
     *
     * @return array
     */
    public function transformData($model)
    {
        return $model->toArray();
    }
}
