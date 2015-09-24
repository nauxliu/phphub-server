<?php

namespace PHPHub\Repositories;

/**
 * Interface ReplyRepository.
 */
interface ReplyRepositoryInterface extends RepositoryInterface
{
    /**
     * 通过 TopicId 过滤.
     *
     * @param $topic_id
     *
     * @return $this
     */
    public function byTopicId($topic_id);

    /**
     * 通过 UserId 过滤.
     *
     * @param $user_id
     *
     * @return $this
     */
    public function byUserId($user_id);
}
