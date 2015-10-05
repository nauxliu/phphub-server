<?php

namespace PHPHub\Repositories\Eloquent;

use Auth;
use PHPHub\Presenters\UserPresenter;
use PHPHub\Repositories\UserRepositoryInterface;
use Prettus\Repository\Criteria\RequestCriteria;
use PHPHub\User;
use Prettus\Validator\Contracts\ValidatorInterface;

/**
 * Class UserRepositoryEloquent.
 */
class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * Specify Validator Rules.
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [

        ],
        ValidatorInterface::RULE_UPDATE => [

        ],
    ];

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Boot up the repository, pushing criteria.
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return UserPresenter::class;
    }

    /**
     * 获取指定或当前用户的未读消息数.
     *
     * @param null $user_id
     *
     * @return int|mixed
     */
    public function getUnreadMessagesCount($user_id = null)
    {
        return is_null($user_id) && Auth::check()
            ? Auth::user()->notification_count
            : User::whereId($user_id)->pluck('notification_count');
    }

    /**
     * 设置指定用户的未读消息数.
     *
     * @param $user_id
     * @param $count
     */
    public function setUnreadMessagesCount($user_id, $count)
    {
        User::whereId($user_id)->update(['notification_count' => $count]);
    }

    /**
     * 增加用户的未读消息数.
     *
     * @param $user_id
     * @param $amount
     */
    public function incrementUnreadMessagesCount($user_id, $amount)
    {
        User::whereId($user_id)->increment(['notification_count' => $amount]);
    }
}
