<?php

namespace PHPHub\Repositories\Eloquent;

use Auth;
use PHPHub\Presenters\TopicPresenter;
use PHPHub\Reply;
use PHPHub\Repositories\Criteria\TopicCriteria;
use PHPHub\Repositories\Eloquent\Traits\IncludeUserTrait;
use PHPHub\Repositories\TopicRepositoryInterface;
use PHPHub\Topic;
use PHPHub\Transformers\IncludeManager\Includable;
use PHPHub\Transformers\IncludeManager\IncludeManager;
use PHPHub\User;
use Prettus\Validator\Contracts\ValidatorInterface;

/**
 * Class TopicRepositoryEloquent.
 */
class TopicRepository extends BaseRepository implements TopicRepositoryInterface
{
    use IncludeUserTrait;

    /**
     * Specify Validator Rules.
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'title'   => 'required|min:2',
            'body'    => 'required|min:2',
            'node_id' => 'required|integer',
        ],
        ValidatorInterface::RULE_UPDATE => [

        ],
    ];

    public function create(array $attributes)
    {
        if (!is_null($this->validator)) {
            $this->validator->with($attributes)
                ->passesOrFail(ValidatorInterface::RULE_CREATE);
        }

        $attributes = array_merge($attributes, [
            'user_id'       => Auth::id(),
            'title'         => $attributes['title'], //TODO: 使用 auto-correct
            'body'          => $attributes['body'],  //TODO: 解析为 Markdown
            'body_original' => $attributes['body'],
            'excerpt'       => $attributes['body'],  //TODO: 生成摘要
        ]);

        $topic = new Topic($attributes);

        $topic->setRawAttributes($attributes);

        $topic->save();

        return $topic;
    }

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
     * 引入帖子最后评论者.
     *
     * @param $default_columns
     */
    public function includeLastReplyUser($default_columns)
    {
        $available_include = Includable::make('last_reply_user')
            ->setDefaultColumns($default_columns)
            ->setAllowColumns(Reply::$includable)
            ->setForeignKey('user_id');

        app(IncludeManager::class)->add($available_include);
    }

    /**
     * 引入帖子所属节点.
     *
     * @param $default_columns
     */
    public function includeNode($default_columns)
    {
        $available_include = Includable::make('node')
            ->setDefaultColumns($default_columns)
            ->setAllowColumns(Reply::$includable)
            ->setForeignKey('node_id');

        app(IncludeManager::class)->add($available_include);
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
