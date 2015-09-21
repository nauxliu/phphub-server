<?php

/**
 * Created by PhpStorm.
 * User: xuan
 * Date: 9/22/15
 * Time: 12:02 AM.
 */
namespace App\Repositories\Eloquent\Traits;

trait WIthOnlyTrait
{
    /**
     * Load relations and specific columns.
     *
     * @param array|string $relations
     * @param null         $columns
     *
     * @return $this
     */
    public function withOnly($relations, $columns = null)
    {
        if (!$columns) {
            $this->model = $this->model->with($relations);
        } else {
            $this->model = $this->model->with([$relations => function ($query) use ($columns) {
                $query->select(array_merge(['id'], $columns));
            }]);
        }

        return $this;
    }
}
