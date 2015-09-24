<?php

namespace PHPHub\Http\ApiControllers;

use PHPHub\Node;
use PHPHub\Reply;
use PHPHub\Repositories\TopicRepositoryInterface;
use PHPHub\Transformers\IncludeManager\Includable;
use PHPHub\Transformers\IncludeManager\IncludeManager;
use PHPHub\Transformers\TopicTransformer;
use PHPHub\User;
use Illuminate\Http\Request;

class TopicsController extends Controller
{
    /**
     * @var TopicRepositoryInterface
     */
    private $repository;

    /**
     * TopicController constructor.
     *
     * @param TopicRepositoryInterface $repository
     */
    public function __construct(TopicRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $include_manager = app(IncludeManager::class);

        $include_manager->add((new Includable('user'))
            ->setDefaultColumns(['name', 'avatar'])
            ->setAllowColumns(User::$includable)
            ->setForeignKey('user_id'));

        $include_manager->add((new Includable('last_reply_user'))
            ->setDefaultColumns('name')
            ->setAllowColumns(User::$includable)
            ->setForeignKey('last_reply_user_id'));

        $include_manager->add((new Includable('node'))
            ->setDefaultColumns('name')
            ->setAllowColumns(Node::$includable)
            ->setForeignKey('node_id'));

        $data = $this->repository
            ->autoWith()
            ->skipPresenter()
            ->autoWithRootColumns([
                'id', 'title', 'is_excellent', 'reply_count', 'updated_at',
            ])
            ->paginate(per_page());

        return $this->response()->paginator($data, new TopicTransformer());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $include_manager = app(IncludeManager::class);

        $include_manager->add((new Includable('user'))
            ->setDefaultColumns(['name', 'avatar'])
            ->setAllowColumns(User::$includable)
            ->setForeignKey('user_id'));

        $include_manager->add((new Includable('replies'))
            ->setDefaultColumns(['body_original', 'vote_count'])
            ->setAllowColumns(User::$includable)
            ->setLimit(per_page()));

        $include_manager->add((new Includable('replies.user'))
            ->setDefaultColumns(['name', 'avatar'])
            ->setAllowColumns(Node::$includable)
            ->nested());

        $data = $this->repository->skipPresenter()->autoWith()->find($id);

        return $this->response()->item($data, new TopicTransformer());
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
