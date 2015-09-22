<?php

namespace App\Transformers;

use App\Transformers\Traits\HelpersTrait;
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
        return [
            'id'         => (int) $model->id,
            'body'       => $model->body_original,
            'created_at' => $model->created_at,
        ];
    }
}
