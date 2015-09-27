<?php

/**
 * Created by PhpStorm.
 * User: xuan
 * Date: 9/21/15
 * Time: 6:30 PM.
 */
namespace PHPHub\Repositories\Eloquent;

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
        $this->app      = $app;
        $this->criteria = new Collection();
        $this->makeModel();
        $this->makeValidator();
        $this->boot();
    }
}
