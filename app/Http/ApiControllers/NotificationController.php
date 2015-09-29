<?php

namespace PHPHub\Http\ApiControllers;

use PHPHub\Repositories\NotificationRepositoryInterface;
use PHPHub\Transformers\NotificationTransformer;

class NotificationController extends Controller
{
    /**
     * @var NotificationRepositoryInterface
     */
    private $repository;

    /**
     * NotificationController constructor.
     *
     * @param NotificationRepositoryInterface $repository
     */
    public function __construct(NotificationRepositoryInterface $repository)
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
        $this->repository->addAvailableInclude('from_user', ['name', 'avatar']);
        $this->repository->addAvailableInclude('reply', ['created_at']);
        $this->repository->addAvailableInclude('topic', ['title']);

        $data = $this->repository
            ->autoWith()
            ->autoWithRootColumns(['id', 'type', 'body'])
            ->paginate(per_page());

        return $this->response()->paginator($data, new NotificationTransformer());
    }
}
