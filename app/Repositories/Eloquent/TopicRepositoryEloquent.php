<?php

namespace App\Repositories\Eloquent;

use App\Presenters\TopicPresenter;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TopicRepository;
use App\Models\Topic;

/**
 * Class TopicRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class TopicRepositoryEloquent extends BaseRepository implements TopicRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Topic::class;
    }

    /**
     * Boot up the repository, pushing criteria
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
