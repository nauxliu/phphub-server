<?php

namespace PHPHub;

use PHPHub\Presenters\TopicPresenter;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\PresenterInterface;
use Prettus\Repository\Traits\PresentableTrait;

class Topic extends Model implements PresenterInterface
{
    use PresentableTrait;

    protected $fillable = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function node()
    {
        return $this->belongsTo(Node::class);
    }

    public function lastReplyUser()
    {
        return $this->belongsTo(User::class, 'last_reply_user_id');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    /**
     * Prepare data to present.
     *
     * @param $data
     *
     * @return mixed
     */
    public function present($data)
    {
        return TopicPresenter::class;
    }
}
