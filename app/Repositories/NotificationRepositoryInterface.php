<?php

namespace PHPHub\Repositories;

/**
 * Interface NotificationRepository.
 */
interface NotificationRepositoryInterface extends RepositoryInterface
{
    /**
     * 添加 UserId 筛选条件.
     *
     * @param $user_id
     *
     * @return $this
     */
    public function byUserId($user_id);
}
