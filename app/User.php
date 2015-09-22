<?php

namespace App;

use App\Presenters\UserPresenter;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\PresenterInterface;
use Prettus\Repository\Traits\PresentableTrait;

class User extends Model implements PresenterInterface
{
    use PresentableTrait;

    public static $includable = [
        'id',
        'name',
        'avatar',
        'github_id',
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
        'real_name',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [];

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

    /**
     * Prepare data to present.
     *
     * @param $data
     *
     * @return mixed
     */
    public function present($data)
    {
        return UserPresenter::class;
    }
}
