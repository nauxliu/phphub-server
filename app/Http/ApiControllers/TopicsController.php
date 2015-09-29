<?php

namespace PHPHub\Http\ApiControllers;

use Gate;
use PHPHub\Repositories\TopicRepositoryInterface;
use PHPHub\Transformers\TopicTransformer;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

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
        $this->repository->addAvailableInclude('user', ['name', 'avatar']);
        $this->repository->addAvailableInclude('last_reply_user', ['name']);
        $this->repository->addAvailableInclude('node', ['name']);

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
        $this->repository->addAvailableInclude('user', ['name', 'avatar']);
        $this->repository->addAvailableInclude('replies', ['vote_count']);
        $this->repository->addAvailableInclude('replies.user', ['name', 'avatar']);

        $data = $this->repository->skipPresenter()->autoWith()->find($id);

        return $this->response()->item($data, new TopicTransformer());
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
        $topic = $this->repository->find($id);

        if (Gate::denies('delete', $topic)) {
            throw new AccessDeniedHttpException();
        }

        $this->repository->delete($id);
    }
}
