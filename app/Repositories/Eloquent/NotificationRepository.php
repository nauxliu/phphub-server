<?php

namespace PHPHub\Repositories\Eloquent;

use PHPHub\Repositories\Eloquent\Traits\IncludeTopicTrait;
use PHPHub\Transformers\IncludeManager\Includable;
use PHPHub\Transformers\IncludeManager\IncludeManager;
use PHPHub\User;
use Prettus\Repository\Criteria\RequestCriteria;
use PHPHub\Repositories\NotificationRepositoryInterface;
use PHPHub\Notification;

/**
 * Class NotificationRepositoryEloquent.
 */
class NotificationRepository extends BaseRepository implements NotificationRepositoryInterface
{
    use IncludeTopicTrait;

    public function includeFromUser($default_columns)
    {
        $available_include = Includable::make('from_user')
            ->setDefaultColumns($default_columns)
            ->setAllowColumns(User::$includable)
            ->setForeignKey('from_user_id');

        app(IncludeManager::class)->add($available_include);
    }

    public function includeReply($default_columns)
    {
        $available_include = Includable::make('reply')
            ->setDefaultColumns($default_columns)
            ->setAllowColumns(User::$includable)
            ->setForeignKey('reply_id');

        app(IncludeManager::class)->add($available_include);
    }

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

    /**
     * 添加 UserId 筛选条件.
     *
     * @param $user_id
     *
     * @return $this
     */
    public function byUserId($user_id)
    {
        $this->model = $this->model->where(compact('user_id'));

        return $this;
    }
}
