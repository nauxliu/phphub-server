<?php

namespace PHPHub;

use McCool\LaravelAutoPresenter\HasPresenter;
use PHPHub\Presenters\UserPresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements HasPresenter, AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    public static $includable = [
        'id',
        'name',
        'avatar',
        'topic_count',
        'reply_count',
        'notification_count',
        'is_banned',
        'twitter_account',
        'company',
        'city',
        'email',
        'signature',
        'introduction',
        'github_name',
        'github_url',
        'real_name',
        'personal_website',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'real_name',
        'city',
        'company',
        'twitter_account',
        'personal_website',
        'signature',
        'introduction',
    ];

    protected $casts = [
        'id'                 => 'int',
        'github_id'          => 'int',
        'topic_count'        => 'int',
        'reply_count'        => 'int',
        'notification_count' => 'int',
        'is_banned'          => 'boolean',
    ];

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function favoriteTopics()
    {
        return $this->belongsToMany(Topic::class, 'favorites')->withPivot('created_at');
    }

    /**
     * Get the presenter class.
     *
     * @return string
     */
    public function getPresenterClass()
    {
        return UserPresenter::class;
    }
}
