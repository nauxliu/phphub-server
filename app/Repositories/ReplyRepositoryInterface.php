<?php

namespace App\Repositories;

/**
 * Interface ReplyRepository.
 */
interface ReplyRepositoryInterface extends RepositoryInterface
{
    /**
     * @param $topic_id
     * @return $this
     */
    public function byTopicId($topic_id);
}
