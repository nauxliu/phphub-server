<?php

namespace PHPHub\Repositories\Eloquent\Traits;

trait WithOnlyTrait
{
    /**
     * Load relations and specific columns.
     *
     * @param array|string $relation
     * @param null         $columns
     * @param bool         $with_trashed
     *
     * @return $this
     */
    public function withOnly($relation, $columns = null, $with_trashed = false)
    {
        $this->model = $this->model->with([$relation => function ($query) use ($columns, $with_trashed) {
            if ($with_trashed) {
                $query->withTrashed();
            }
            if ($columns) {
                $query->select(array_merge(['id'], $columns));
            }
        }]);

        return $this;
    }
}
