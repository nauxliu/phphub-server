<?php

/**
 * Created by PhpStorm.
 * User: xuan
 * Date: 9/21/15
 * Time: 6:30 PM.
 */
namespace PHPHub\Repositories\Eloquent;

use DB;
use PHPHub\Repositories\Eloquent\Traits\AutoWithTrait;
use PHPHub\Repositories\Eloquent\Traits\WithOnlyTrait;
use Prettus\Repository\Eloquent\BaseRepository as Repository;
use Illuminate\Container\Container as Application;
use Illuminate\Support\Collection;

abstract class BaseRepository extends Repository
{
    use WithOnlyTrait, AutoWithTrait;

    /**
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->criteria = new Collection();
        $this->makeModel();
        $this->makeValidator();
        $this->boot();
    }

    /**
     * whereIn 查询并按照数组内数据排序.
     *
     * @param array  $data
     * @param string $column
     *
     * @return $this
     */
    public function whereInAndOrderBy(array $data, $column = 'id')
    {
        $this->model = $this->model
            ->whereIn('id', $data)
            ->orderByRaw(DB::raw("FIELD($column, ".implode(',', $data).')'));

        return $this;
    }

    public function get()
    {
        return $this->model->get();
    }
}
