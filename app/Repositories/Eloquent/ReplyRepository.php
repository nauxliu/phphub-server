<?php

namespace PHPHub\Repositories\Eloquent;

use Auth;
use PHPHub\Events\NewReply;
use PHPHub\Repositories\Criteria\ReplyCriteria;
use PHPHub\Repositories\Eloquent\Traits\IncludeUserTrait;
use PHPHub\Repositories\ReplyRepositoryInterface;
use PHPHub\Reply;
use Prettus\Validator\Contracts\ValidatorInterface;

/**
 * Class ReplyRepositoryEloquent.
 */
class ReplyRepository extends BaseRepository implements ReplyRepositoryInterface
{
    use IncludeUserTrait;

    /**
     * Specify Validator Rules.
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'body'     => 'required|min:2',
            'topic_id' => 'required|integer',
        ],
        ValidatorInterface::RULE_UPDATE => [

        ],
    ];

    /**
     * 发布新的评论.
     *
     * @param array $attributes
     *
     * @return Reply
     */
    public function store(array $attributes)
    {
        if (! is_null($this->validator)) {
            $this->validator->with($attributes)
                ->passesOrFail(ValidatorInterface::RULE_CREATE);
        }

        $reply = new Reply($attributes);

        $reply->user_id = Auth::id();
        $reply->body = app('markdown')->text($attributes['body']);
        $reply->body_original = $attributes['body'];

        $reply->save();

        $reply->topic()->getQuery()->increment('reply_count');

        event(new NewReply($reply, Auth::id(), $reply->topic()->getQuery()->pluck('user_id')));

        return $reply;
    }

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Reply::class;
    }

    /**
     * Boot up the repository, pushing criteria.
     */
    public function boot()
    {
        $this->pushCriteria(app(ReplyCriteria::class));
    }

    /**
     * 通过 TopicId 过滤.
     *
     * @param $topic_id
     *
     * @return $this
     */
    public function byTopicId($topic_id)
    {
        $this->model = $this->model->where('topic_id', $topic_id);

        return $this;
    }

    /**
     * 通过 UserId 过滤.
     *
     * @param $user_id
     *
     * @return $this
     */
    public function byUserId($user_id)
    {
        $this->model = $this->model->where('user_id', $user_id);

        return $this;
    }
}
