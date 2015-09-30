<?php

namespace PHPHub\Repositories;

use PHPHub\Topic;

/**
 * Interface TopicRepositoryInterface.
 */
interface TopicRepositoryInterface extends RepositoryInterface
{
    /**
     * 支持帖子.
     *
     * @param Topic $topic
     *
     * @return bool
     */
    public function voteUp(Topic $topic);

    /**
     * 反对帖子.
     *
     * @param Topic $topic
     *
     * @return bool
     */
    public function voteDown(Topic $topic);
}
