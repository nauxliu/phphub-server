<?php

/**
 * Created by PhpStorm.
 * User: xuan
 * Date: 9/22/15
 * Time: 8:07 AM.
 */
namespace PHPHub\Repositories\Criteria;

use Illuminate\Database\Eloquent\Builder;

class TopicCriteria extends BaseCriteria
{
    /**
     * 精华帖子.
     *
     * @param $model
     */
    public function filterExcellent(Builder $model)
    {
        $model->where('is_excellent', 1);
    }

    /**
     * Wiki 帖子.
     *
     * @param $model
     */
    public function filterWiki(Builder $model)
    {
        $model->where('is_wiki', 1);
    }

    /**
     * 最新发表的帖子.
     *
     * @param $model
     */
    public function filterRecent(Builder $model)
    {
        $model->orderBy('created_at', 'desc');
    }

    /**
     * 按照投票数倒序排序.
     *
     * @param $model
     */
    public function filterVote(Builder $model)
    {
        $model->orderBy('vote_count', 'desc');
    }

    /**
     * 无人回复的帖子.
     *
     * @param $model
     */
    public function filterNobody(Builder $model)
    {
        $model->where('reply_count', 0);
    }

    /**
     * 招聘节点下的帖子.
     *
     * @param $model
     */
    public function filterJobs(Builder $model)
    {
        $model->where('node_id', 40);
    }
}
