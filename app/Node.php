<?php

namespace PHPHub;

use McCool\LaravelAutoPresenter\HasPresenter;
use PHPHub\Presenters\NodePresenter;
use Illuminate\Database\Eloquent\Model;

class Node extends Model implements HasPresenter
{
    public static $includable = [];
    protected $fillable       = [];

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    /**
     * Get the presenter class.
     *
     * @return string
     */
    public function getPresenterClass()
    {
        return NodePresenter::class;
    }
}
