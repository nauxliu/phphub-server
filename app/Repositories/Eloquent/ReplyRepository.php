<?php

namespace App\Repositories\Eloquent;

use App\Presenters\ReplyPresenter;
use App\Repositories\ReplyRepositoryInterface;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Reply;

/**
 * Class ReplyRepositoryEloquent.
 */
class ReplyRepositoryEloquent extends BaseRepository implements ReplyRepositoryInterface
{
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
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return ReplyPresenter::class;
    }
}
