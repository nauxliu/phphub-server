<?php

namespace PHPHub;

use Illuminate\Database\Eloquent\SoftDeletes;
use McCool\LaravelAutoPresenter\HasPresenter;
use PHPHub\Presenters\TopicPresenter;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model implements HasPresenter
{
    use SoftDeletes;

    public static $includable = [
        'id',
        'title',
        'body',
        'user_id',
        'node_id',
        'is_excellent',
        'is_wiki',
        'is_blocked',
        'reply_count',
        'view_count',
        'favorite_count',
        'vote_count',
        'last_reply_user_id',
        'created_at',
        'updated_at',
        'body_original',
        'excerpt',
    ];

    protected $fillable = ['body', 'title', 'node_id', 'user_id'];

    protected $morphClass = 'Topic';

    protected $casts = [
        'id'                 => 'int',
        'user_id'            => 'int',
        'node_id'            => 'int',
        'last_reply_user_id' => 'int',
        'favorite_count'     => 'int',
        'view_count'         => 'int',
        'reply_count'        => 'int',
        'vote_count'         => 'int',
        'notification_count' => 'int',
        'is_excellent'       => 'boolean',
        'is_wiki'            => 'boolean',
        'is_blocked'         => 'boolean',
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

    public function favoriteBy()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }

    public function attentionBy()
    {
        return $this->belongsToMany(User::class, 'attentions')->withTimestamps();
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
