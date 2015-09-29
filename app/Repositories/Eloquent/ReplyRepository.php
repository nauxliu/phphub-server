<?php

namespace PHPHub\Repositories\Eloquent;

use PHPHub\Presenters\ReplyPresenter;
use PHPHub\Repositories\Criteria\ReplyCriteria;
use PHPHub\Repositories\Eloquent\Traits\IncludeUserTrait;
use PHPHub\Repositories\ReplyRepositoryInterface;
use PHPHub\Reply;

/**
 * Class ReplyRepositoryEloquent.
 */
class ReplyRepository extends BaseRepository implements ReplyRepositoryInterface
{
    use IncludeUserTrait;

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Reply::class;
    }

    /**
     * Boot up the repository, pushing criteria.
     */
    public function boot()
    {
        $this->pushCriteria(app(ReplyCriteria::class));
    }

    public function presenter()
    {
        return ReplyPresenter::class;
    }

    /**
     * 通过 TopicId 过滤.
     *
     * @param $topic_id
     *
     * @return $this
     */
    public function byTopicId($topic_id)
    {
        $this->model->where('topic_id', $topic_id);

        return $this;
    }

    /**
     * 通过 UserId 过滤.
     *
     * @param $user_id
     *
     * @return $this
     */
    public function byUserId($user_id)
    {
        $this->model->where('user_id', $user_id);

        return $this;
    }
}
