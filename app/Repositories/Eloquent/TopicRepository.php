<?php

namespace PHPHub\Repositories\Eloquent;

use Auth;
use DB;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Pagination\Paginator;
use PHPHub\Events\TopicUpVoted;
use PHPHub\Reply;
use PHPHub\Repositories\Criteria\TopicCriteria;
use PHPHub\Repositories\Eloquent\Traits\IncludeUserTrait;
use PHPHub\Repositories\TopicRepositoryInterface;
use PHPHub\Topic;
use PHPHub\Transformers\IncludeManager\Includable;
use PHPHub\Transformers\IncludeManager\IncludeManager;
use PHPHub\User;
use PHPHub\Vote;
use Prettus\Validator\Contracts\ValidatorInterface;
use ReflectionObject;

/**
 * Class TopicRepositoryEloquent.
 */
class TopicRepository extends BaseRepository implements TopicRepositoryInterface
{
    use IncludeUserTrait, DispatchesJobs;

    protected $favorite_table = 'favorites';
    protected $attention_table = 'attentions';

    /**
     * Specify Validator Rules.
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'title'   => 'required|min:2',
            'body'    => 'required|min:2',
            'node_id' => 'required|integer|exists:nodes,id',
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
            ->setForeignKey('last_reply_user_id');

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

    /**
     * 支持帖子.
     *
     * @param Topic $topic
     *
     * @return bool
     */
    public function voteUp(Topic $topic)
    {
        if ($this->userUpVoted($topic->id, Auth::id())) {
            $this->resetVote($topic->id, Auth::id());
            $topic->decrement('vote_count', 1);

            return false;
        }

        $vote_count = 0;

        if ($this->userDownVoted($topic->id, Auth::id())) {
            $this->resetVote($topic->id, Auth::id());
            $vote_count = 1;
        }

        $topic->votes()->create([
            'is'      => 'upvote',
            'user_id' => Auth::id(),
        ]);

        $topic->increment('vote_count', $vote_count + 1);

        \Event::fire(new TopicUpVoted($topic, Auth::id()));

        return true;
    }

    /**
     * 反对帖子.
     *
     * @param Topic $topic
     *
     * @return bool
     */
    public function voteDown(Topic $topic)
    {
        if ($this->userDownVoted($topic->id, Auth::id())) {
            $this->resetVote($topic->id, Auth::id());
            $topic->increment('vote_count', 1);

            return false;
        }

        $vote_count = 0;

        if ($this->userUpVoted($topic->id, Auth::id())) {
            $this->resetVote($topic->id, Auth::id());
            $vote_count = 1;
        }

        $topic->votes()->create([
            'is'      => 'downvote',
            'user_id' => Auth::id(),
        ]);

        $topic->decrement('vote_count', $vote_count + 1);

        return true;
    }

    /**
     * 重置投票.
     *
     * @param $topic_id
     * @param $user_id
     *
     * @return mixed
     */
    protected function resetVote($topic_id, $user_id)
    {
        return Vote::query()->where([
            'user_id'      => $user_id,
            'votable_id'   => $topic_id,
            'votable_type' => 'Topic',
        ])->delete();
    }

    /**
     * 是否已经支持帖子.
     *
     * @param $topic_id
     * @param $user_id
     *
     * @return bool
     */
    public function userUpVoted($topic_id, $user_id)
    {
        return Vote::query()->where([
            'user_id'      => $user_id,
            'votable_id'   => $topic_id,
            'votable_type' => 'Topic',
            'is'           => 'upvote',
        ])->exists();
    }

    /**
     * 是否已经反对帖子.
     *
     * @param $topic_id
     * @param $user_id
     *
     * @return bool
     */
    public function userDownVoted($topic_id, $user_id)
    {
        return Vote::query()->where([
            'user_id'      => $user_id,
            'votable_id'   => $topic_id,
            'votable_type' => 'Topic',
            'is'           => 'downvote',
        ])->exists();
    }

    /**
     * 用户是否已经收藏帖子.
     *
     * @param $topic_id
     * @param $user_id
     *
     * @return bool
     */
    public function userFavorite($topic_id, $user_id)
    {
        return DB::table($this->favorite_table)->where(compact('topic_id', 'user_id'))->exists();
    }

    /**
     * 用户是否已经关注帖子.
     *
     * @param $topic_id
     * @param $user_id
     *
     * @return bool
     */
    public function userAttention($topic_id, $user_id)
    {
        return DB::table($this->attention_table)->where(compact('topic_id', 'user_id'))->exists();
    }

    /**
     * 用户收藏的帖子.
     *
     * @param $user_id
     * @param $columns
     *
     * @return Paginator
     */
    public function favoriteTopicsWithPaginator($user_id, $columns = ['*'])
    {
        return $this->getTopicsWithPaginatorBy($this->favorite_table, $user_id, $columns);
    }

    /**
     * 用户关注的帖子.
     *
     * @param $user_id
     * @param $columns
     *
     * @return Paginator
     */
    public function attentionTopicsWithPaginator($user_id, $columns = ['*'])
    {
        return $this->getTopicsWithPaginatorBy($this->attention_table, $user_id, $columns);
    }

    /**
     * 通过 attentions 或 favorites 查找帖子.
     *
     * @param $table
     * @param $user_id
     * @param $columns
     *
     * @return Paginator
     */
    public function getTopicsWithPaginatorBy($table, $user_id, $columns = ['*'])
    {
        $paginator = DB::table($table)
            ->orderBy('created_at', 'desc')
            ->where(compact('user_id'))
            ->paginate(per_page(), ['topic_id']);

        if ($paginator->count() === 0) {
            return $paginator;
        }

        $topic_ids = array_pluck($paginator->items(), 'topic_id');
        $topics = $this->whereInAndOrderBy($topic_ids)
            ->autoWith()
            ->autoWithRootColumns($columns)
            ->get();

        $items = (new ReflectionObject($paginator))->getProperty('items');
        $items->setAccessible(true);
        $items->setValue($paginator, $topics);

        return $paginator;
    }

    /**
     * 添加 node_id 过滤条件.
     *
     * @param $node_id
     *
     * @return $this
     */
    public function byNodeId($node_id)
    {
        $this->model = $this->model->where(compact('node_id'));

        return $this;
    }

    /**
     * 添加 user_id 过滤条件.
     *
     * @param $user_id
     *
     * @return $this
     */
    public function byUserId($user_id)
    {
        $this->model = $this->model->where(compact('user_id'));

        return $this;
    }

    /**
     * 收藏帖子.
     *
     * @param $topic_id
     * @param $user_id
     */
    public function favorite($topic_id, $user_id)
    {
        $topic = new Topic();
        $topic->id = $topic_id;

        if ($topic->favoriteBy()->wherePivot('user_id', $user_id)->exists()) {
            return;
        }

        $topic->favoriteBy()->attach($user_id);
    }

    /**
     * 取消收藏帖子.
     *
     * @param $topic_id
     * @param $user_id
     */
    public function unFavorite($topic_id, $user_id)
    {
        $topic = new Topic();
        $topic->id = $topic_id;
        $topic->favoriteBy()->detach($user_id);
    }

    /**
     * 关注帖子.
     *
     * @param $topic_id
     * @param $user_id
     */
    public function attention($topic_id, $user_id)
    {
        $topic = new Topic();
        $topic->id = $topic_id;

        if ($topic->attentionBy()->wherePivot('user_id', $user_id)->exists()) {
            return;
        }

        $topic->attentionBy()->attach($user_id);
    }

    /**
     * 取消关注帖子.
     *
     * @param $topic_id
     * @param $user_id
     */
    public function unAttention($topic_id, $user_id)
    {
        $topic = new Topic();
        $topic->id = $topic_id;
        $topic->attentionBy()->detach($user_id);
    }
}
