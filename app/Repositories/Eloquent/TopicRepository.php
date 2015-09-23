<?php

namespace PHPHub\Repositories\Eloquent;

use PHPHub\Presenters\TopicPresenter;
use PHPHub\Repositories\Criteria\TopicCriteria;
use PHPHub\Repositories\TopicRepositoryInterface;
use PHPHub\Topic;

/**
 * Class TopicRepositoryEloquent.
 */
class TopicRepository extends BaseRepository implements TopicRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Topic::class;
    }

    /**
     * Boot up the repository, pushing criteria.
     */
    public function boot()
    {
        $this->pushCriteria(app(TopicCriteria::class));
    }

    public function presenter()
    {
        return TopicPresenter::class;
    }
}
