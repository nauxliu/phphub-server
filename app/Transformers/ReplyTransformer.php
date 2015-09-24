<?php

namespace PHPHub\Transformers;

use PHPHub\Transformers\Traits\HelpersTrait;
use League\Fractal\TransformerAbstract;

/**
 * Class ReplyTransformer.
 */
class ReplyTransformer extends TransformerAbstract
{
    use HelpersTrait;

    /**
     * Resources that can be included if requested.
     *
     * @var array
     */
    protected $availableIncludes = array('user');

    /**
     * Transform the \Reply entity.
     *
     * @param \Reply $model
     *
     * @return array
     */
    public function transformData($model)
    {
        return $model->toArray();
    }

    public function includeUser($model)
    {
        return $this->item($model->user, new UserTransformer());
    }
}
