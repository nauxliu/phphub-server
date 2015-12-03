<?php

namespace PHPHub;

use McCool\LaravelAutoPresenter\HasPresenter;
use PHPHub\Presenters\NodePresenter;
use Illuminate\Database\Eloquent\Model;

class Node extends Model implements HasPresenter
{
    public static $includable = ['id', 'name', 'slug', 'parent_node', 'description'];
    protected $fillable = [];

    protected $casts = [
        'id'          => 'int',
        'parent_node' => 'int',
    ];

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
