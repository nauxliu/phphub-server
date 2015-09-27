<?php

namespace PHPHub\Repositories\Eloquent;

use PHPHub\Presenters\TopicPresenter;
use PHPHub\Reply;
use PHPHub\Repositories\Criteria\TopicCriteria;
use PHPHub\Repositories\Eloquent\Traits\IncludeUserTrait;
use PHPHub\Repositories\TopicRepositoryInterface;
use PHPHub\Topic;
use PHPHub\Transformers\IncludeManager\Includable;
use PHPHub\Transformers\IncludeManager\IncludeManager;
use PHPHub\User;

/**
 * Class TopicRepositoryEloquent.
 */
class TopicRepository extends BaseRepository implements TopicRepositoryInterface
{
    use IncludeUserTrait;

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Topic::class;
    }

    /**
     * 引入帖子的评论.
     *
     * @param $default_columns
     */
    public function includeReplies($default_columns)
    {
        $available_include = Includable::make('replies')
            ->setDefaultColumns($default_columns)
            ->setAllowColumns(Reply::$includable)
            ->setLimit(per_page());

        app(IncludeManager::class)->add($available_include);
    }

    /**
     * 引入帖子每个的评论发布者.
     *
     * @param $default_columns
     */
    public function includeRepliesUser($default_columns)
    {
        $available_include = Includable::make('replies.user')
            ->setDefaultColumns($default_columns)
            ->setAllowColumns(User::$includable)
            ->nested('replies');

        app(IncludeManager::class)->add($available_include);
    }

    /**
     * Boot up the repository, pushing criteria.
     */
    public function boot()
    {
        $this->pushCriteria(app(TopicCriteria::class));
    }

    public function presenter()
    {
        return TopicPresenter::class;
    }
}
