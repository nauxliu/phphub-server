<?php

namespace App\Repositories\Eloquent;

use App\Presenters\UserPresenter;
use App\Repositories\UserRepositoryInterface;
use Prettus\Repository\Criteria\RequestCriteria;
use App\User;

/**
 * Class UserRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
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
        return UserPresenter::class;
    }
}
