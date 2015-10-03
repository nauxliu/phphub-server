<?php

namespace PHPHub;

use McCool\LaravelAutoPresenter\HasPresenter;
use PHPHub\Presenters\TopicPresenter;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model implements HasPresenter
{
    protected $fillable   = ['body', 'title'];
    protected $morphClass = 'Topic';

    protected $casts = [
        'id'                 => 'int',
        'github_id'          => 'int',
        'topic_count'        => 'int',
        'reply_count'        => 'int',
        'notification_count' => 'int',
        'is_banned'          => 'boolean',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function votes()
    {
        return $this->morphMany(Vote::class, 'votable');
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
     * Get the presenter class.
     *
     * @return string
     */
    public function getPresenterClass()
    {
        return TopicPresenter::class;
    }
}
