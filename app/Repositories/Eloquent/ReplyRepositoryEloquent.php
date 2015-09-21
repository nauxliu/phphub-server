<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ReplyRepository;
use App\Models\Reply;

/**
 * Class ReplyRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class ReplyRepositoryEloquent extends BaseRepository implements ReplyRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Reply::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
