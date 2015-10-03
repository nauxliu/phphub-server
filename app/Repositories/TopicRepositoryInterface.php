<?php

namespace PHPHub\Repositories;

use Illuminate\Pagination\Paginator;
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

    /**
     * 用户收藏的帖子.
     *
     * @param $user_id
     * @param $columns
     *
     * @return Paginator
     */
    public function favoriteTopicsWithPaginator($user_id, $columns = ['*']);

    /**
     * 添加 node_id 过滤条件.
     *
     * @param $node_id
     *
     * @return $this
     */
    public function byNodeId($node_id);

    /**
     * 添加 user_id 过滤条件.
     *
     * @param $user_id
     *
     * @return $this
     */
    public function byUserId($user_id);
}
