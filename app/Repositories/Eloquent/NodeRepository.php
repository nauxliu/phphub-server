<?php

namespace PHPHub\Repositories\Eloquent;

use Prettus\Repository\Criteria\RequestCriteria;
use PHPHub\Repositories\NodeRepositoryInterface;
use PHPHub\Node;

/**
 * Class NodeRepositoryEloquent.
 */
class NodeRepository extends BaseRepository implements NodeRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Node::class;
    }

    /**
     * Boot up the repository, pushing criteria.
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
