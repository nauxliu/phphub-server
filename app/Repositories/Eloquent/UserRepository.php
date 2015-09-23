<?php

namespace PHPHub\Repositories\Eloquent;

use PHPHub\Presenters\UserPresenter;
use PHPHub\Repositories\UserRepositoryInterface;
use Prettus\Repository\Criteria\RequestCriteria;
use PHPHub\User;

/**
 * Class UserRepositoryEloquent.
 */
class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return User::class;
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
        return UserPresenter::class;
    }
}
