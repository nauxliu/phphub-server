<?php

namespace PHPHub\Http\ApiControllers;

use PHPHub\Repositories\ReplyRepositoryInterface;
use PHPHub\Transformers\IncludeManager\Includable;
use PHPHub\Transformers\IncludeManager\IncludeManager;
use PHPHub\Transformers\ReplyTransformer;
use PHPHub\User;
use Illuminate\Http\Request;

class RepliesController extends Controller
{
    /**
     * @var ReplyRepositoryInterface
     */
    private $repository;

    /**
     * TopicController constructor.
     *
     * @param ReplyRepositoryInterface $repository
     */
    public function __construct(ReplyRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the replies by topic id.
     *
     * @param $topic_id
     *
     * @return \Illuminate\Http\Response
     */
    public function indexByTopicId($topic_id)
    {
        $include_manager = app(IncludeManager::class);

        $include_manager->add((new Includable('user'))
            ->setDefaultColumns(['name', 'avatar'])
            ->setAllowColumns(User::$includable)
            ->setForeignKey('user_id'));

        $data = $this->repository
            ->byTopicId($topic_id)
            ->skipPresenter()
            ->autoWith()
            ->autoWithRootColumns(['id', 'vote_count', 'created_at'])
            ->paginate(per_page());

        return $this->response()->paginator($data, new ReplyTransformer());
    }

    public function indexByUserId($user_id)
    {
        $include_manager = app(IncludeManager::class);

        $include_manager->add((new Includable('user'))
            ->setDefaultColumns(['name', 'avatar', 'created_at'])
            ->setAllowColumns(User::$includable)
            ->setForeignKey('user_id'));

        $data = $this->repository
            ->byUserId($user_id)
            ->skipPresenter()
            ->autoWith()
            ->autoWithRootColumns(['id', 'vote_count'])
            ->paginate(per_page());

        return $this->response()->paginator($data, new ReplyTransformer());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
