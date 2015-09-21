<?php

namespace App\Repositories\Eloquent;

use App\Presenters\TopicPresenter;
use App\Repositories\TopicRepositoryInterface;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Topic;

/**
 * Class TopicRepositoryEloquent.
 */
class TopicRepositoryEloquent extends BaseRepository implements TopicRepositoryInterface
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
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return TopicPresenter::class;
    }
}
