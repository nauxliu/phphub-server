<?php

namespace PHPHub\Repositories\Eloquent;

use Prettus\Repository\Criteria\RequestCriteria;
use PHPHub\Repositories\LaunchScreenAdvertRepositoryInterface;
use PHPHub\LaunchScreenAdvert;

/**
 * Class LaunchScreenAdvertRepositoryEloquent.
 */
class LaunchScreenAdvertRepository extends BaseRepository implements LaunchScreenAdvertRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return LaunchScreenAdvert::class;
    }

    /**
     * Boot up the repository, pushing criteria.
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
