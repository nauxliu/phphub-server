<?php

namespace PHPHub\Repositories;

/**
 * Interface NotificationRepositoryInterface.
 */
interface NotificationRepositoryInterface extends RepositoryInterface
{
    /**
     * 用户最新的通知.
     *
     * @param $user_id
     *
     * @return $this
     */
    public function userRecent($user_id);

    /**
     * 生成一条新的 Notification.
     *
     * @param $attributes
     *
     * @return Notification
     */
    public function store($attributes);
}
