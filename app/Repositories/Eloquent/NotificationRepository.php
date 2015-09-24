<?php

namespace PHPHub\Repositories\Eloquent;

use Prettus\Repository\Criteria\RequestCriteria;
use PHPHub\Repositories\NotificationRepositoryInterface;
use PHPHub\Notification;

/**
 * Class NotificationRepositoryEloquent.
 */
class NotificationRepository extends BaseRepository implements NotificationRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Notification::class;
    }

    /**
     * Boot up the repository, pushing criteria.
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
