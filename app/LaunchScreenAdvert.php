<?php

namespace PHPHub;

use Illuminate\Database\Eloquent\Model;
use McCool\LaravelAutoPresenter\HasPresenter;
use PHPHub\Presenters\LaunchScreenAdvertPresenter;

class LaunchScreenAdvert extends Model implements HasPresenter
{
    protected $fillable = [];

    /**
     * Get the presenter class.
     *
     * @return string
     */
    public function getPresenterClass()
    {
        return LaunchScreenAdvertPresenter::class;
    }
}
