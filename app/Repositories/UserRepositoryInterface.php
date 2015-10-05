<?php

namespace PHPHub\Repositories;

/**
 * Interface UserRepositoryInterface.
 */
interface UserRepositoryInterface extends RepositoryInterface
{
    /**
     * 获取指定或当前用户的未读消息数.
     *
     * @param null $user_id
     *
     * @return int|mixed
     */
    public function getUnreadMessagesCount($user_id = null);

    /**
     * 设置指定用户的未读消息数.
     *
     * @param $user_id
     * @param $count
     */
    public function setUnreadMessagesCount($user_id, $count);

    /**
     * 增加用户的未读消息数.
     *
     * @param $user_id
     * @param $amount
     */
    public function incrementUnreadMessagesCount($user_id, $amount);
}
