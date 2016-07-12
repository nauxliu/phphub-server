<?php

/**
 * Created by PhpStorm.
 * User: xuan
 * Date: 9/22/15
 * Time: 8:07 AM.
 */

namespace PHPHub\Repositories\Criteria;

class TopicCriteria extends BaseCriteria
{
    use OrderByCreatedTimeTrait;

    /**
     * 精华帖子.
     *
     * @param $model
     */
    public function filterExcellent($model)
    {
        return $model->where('is_excellent', 'yes');
    }

    /**
     * Wiki 帖子.
     *
     * @param $model
     */
    public function filterWiki($model)
    {
        return $model->where('is_wiki', 'yes');
    }

    /**
     * 按照投票数倒序排序.
     *
     * @param $model
     */
    public function filterVote($model)
    {
        return $model->orderBy('vote_count', 'desc');
    }

    /**
     * 无人回复的帖子.
     *
     * @param $model
     */
    public function filterNobody($model)
    {
        return $model->where('reply_count', 0);
    }

    /**
     * 招聘节点下的帖子.
     *
     * @param $model
     */
    public function filterJobs($model)
    {
        return $model->where('category_id', 1);
    }
}
