<?php

/**
 * Created by PhpStorm.
 * User: xuan
 * Date: 9/22/15
 * Time: 8:07 AM.
 */
namespace App\Repositories\Criteria;

class TopicCriteria extends BaseCriteria
{
    /**
     * 精华帖.
     *
     * @param $model
     */
    public function filterExcellent($model)
    {
        $model->where('is_excellent', 1);
    }

    /**
     * Wiki 帖.
     *
     * @param $model
     */
    public function filterWiki($model)
    {
        $model->where('is_wiki', 1);
    }

    /**
     * 最新发表的贴.
     *
     * @param $model
     */
    public function filterRecent($model)
    {
        $model->orderBy('created_at', 'desc');
    }

    /**
     * 按照投票数倒序排序.
     *
     * @param $model
     */
    public function filterVote($model)
    {
        $model->orderBy('vote_count', 'desc');
    }

    /**
     * 无人回复的贴.
     *
     * @param $model
     */
    public function filterNobody($model)
    {
        $model->where('reply_count', 0);
    }
}
