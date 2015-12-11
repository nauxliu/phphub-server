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
     * 用户关注的帖子.
     *
     * @param $user_id
     * @param $columns
     *
     * @return Paginator
     */
    public function attentionTopicsWithPaginator($user_id, $columns = ['*']);

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

    /**
     * 用户是否已经收藏帖子.
     *
     * @param $topic_id
     * @param $user_id
     *
     * @return bool
     */
    public function userFavorite($topic_id, $user_id);

    /**
     * 用户是否已经关注帖子.
     *
     * @param $topic_id
     * @param $user_id
     *
     * @return bool
     */
    public function userAttention($topic_id, $user_id);

    /**
     * 收藏帖子.
     *
     * @param $topic_id
     * @param $user_id
     *
     * @return
     */
    public function favorite($topic_id, $user_id);

    /**
     * 取消收藏帖子.
     *
     * @param $topic_id
     * @param $user_id
     *
     * @return
     */
    public function unFavorite($topic_id, $user_id);

    /**
     * 关注帖子.
     *
     * @param $topic_id
     * @param $user_id
     */
    public function attention($topic_id, $user_id);

    /**
     * 取消关注帖子.
     *
     * @param $topic_id
     * @param $user_id
     */
    public function unAttention($topic_id, $user_id);

    /**
     * 是否已经支持帖子.
     *
     * @param $topic_id
     * @param $user_id
     *
     * @return bool
     */
    public function userUpVoted($topic_id, $user_id);

    /**
     * 是否已经反对帖子.
     *
     * @param $topic_id
     * @param $user_id
     *
     * @return bool
     */
    public function userDownVoted($topic_id, $user_id);
}
