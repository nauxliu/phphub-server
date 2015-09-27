<?php

namespace PHPHub;

use McCool\LaravelAutoPresenter\HasPresenter;
use PHPHub\Presenters\ReplyPresenter;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model implements HasPresenter
{
    public static $includable = ['id', 'body', 'body_original', 'vote_count'];
    protected $fillable       = [];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the presenter class.
     *
     * @return string
     */
    public function getPresenterClass()
    {
        return ReplyPresenter::class;
    }
}
