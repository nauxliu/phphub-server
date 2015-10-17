<?php

namespace PHPHub;

use Illuminate\Database\Eloquent\Model;
use McCool\LaravelAutoPresenter\HasPresenter;
use PHPHub\Presenters\NotificationPresenter;

class Notification extends Model implements HasPresenter
{
    protected $guarded = [];

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    public function reply()
    {
        return $this->belongsTo(Reply::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    /**
     * Get the presenter class.
     *
     * @return string
     */
    public function getPresenterClass()
    {
        return NotificationPresenter::class;
    }
}
