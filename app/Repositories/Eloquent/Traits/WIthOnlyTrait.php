<?php

namespace App\Repositories\Eloquent\Traits;

trait WIthOnlyTrait
{
    /**
     * Load relations and specific columns.
     *
     * @param array|string $relation
     * @param null         $columns
     *
     * @return $this
     */
    public function withOnly($relation, $columns = null)
    {
        if (!$columns) {
            $this->model = $this->model->with($relation);
        } else {
            $this->model = $this->model->with([$relation => function ($query) use ($columns) {
                $query->select(array_merge(['id'], $columns));
            }]);
        }

        return $this;
    }
}
