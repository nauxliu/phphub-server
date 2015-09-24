<?php

namespace PHPHub\Transformers;

use League\Fractal\TransformerAbstract;
use PHPHub\Notification;
use PHPHub\Transformers\Traits\HelpersTrait;

/**
 * Class NotificationTransformer.
 */
class NotificationTransformer extends TransformerAbstract
{
    use HelpersTrait;

    /**
     * Resources that can be included if requested.
     *
     * @var array
     */
    protected $availableIncludes = array('from_user');

    /**
     * Transform the \Notification entity.
     *
     * @param Notification $model
     *
     * @return array
     */
    public function transformData($model)
    {
        return $model->toArray();
    }

    public function includeFromUser($model)
    {
        return $this->item($model->fromUser, new UserTransformer());
    }
}
