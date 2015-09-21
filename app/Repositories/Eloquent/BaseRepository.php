<?php
/**
 * Created by PhpStorm.
 * User: xuan
 * Date: 9/21/15
 * Time: 6:30 PM
 */

namespace App\Repositories\Eloquent;


use Prettus\Repository\Eloquent\BaseRepository as Repository;

abstract class BaseRepository extends Repository
{
    /**
     * Load relations and specific columns.
     *
     * @param array|string $relations
     * @param null $columns
     * @return $this
     */
    public function withOnly($relations, $columns = null)
    {
        if(!$columns){
            $this->model = $this->model->with($relations);
        }else{
            $this->model = $this->model->with([$relations => function ($query) use ($columns){
                $query->select(array_merge(['id'], $columns));
            }]);
        }

        return $this;
    }
}