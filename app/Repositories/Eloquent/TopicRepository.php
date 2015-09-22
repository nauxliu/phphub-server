<?php

namespace App\Repositories\Eloquent;

use App\Presenters\TopicPresenter;
use App\Repositories\Criteria\TopicCriteria;
use App\Repositories\TopicRepositoryInterface;
use App\Topic;

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
