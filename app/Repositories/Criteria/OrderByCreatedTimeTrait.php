<?php
/**
 * Created by PhpStorm.
 * User: xuan
 * Date: 9/24/15
 * Time: 9:55 AM
 */

namespace PHPHub\Repositories\Criteria;

trait OrderByCreatedTimeTrait
{
    /**
     * 按创建时间倒序排列.
     *
     * @param $model
     */
    public function filterNewest($model)
    {
        return $model->orderBy('created_at', 'desc');
    }

    /**
     * 按创建时间正序排列.
     *
     * @param $builder
     */
    public function filterEarliest($builder)
    {
        return $builder->orderBy('created_at', 'asc');
    }
}