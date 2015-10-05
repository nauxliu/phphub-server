<?php

namespace PHPHub\Http\ApiControllers;

use Auth;
use PHPHub\Repositories\NotificationRepositoryInterface;
use PHPHub\Repositories\UserRepositoryInterface;
use PHPHub\Transformers\NotificationTransformer;

class NotificationController extends Controller
{
    /**
     * @var NotificationRepositoryInterface
     */
    private $repository;
    /**
     * @var UserRepositoryInterface
     */
    private $user_repository;

    /**
     * NotificationController constructor.
     *
     * @param NotificationRepositoryInterface $repository
     * @param UserRepositoryInterface         $user_repository
     */
    public function __construct(NotificationRepositoryInterface $repository, UserRepositoryInterface $user_repository)
    {
        $this->repository      = $repository;
        $this->user_repository = $user_repository;
    }

    /**
     * 获取当前用户的通知消息.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->addAvailableInclude('from_user', ['name', 'avatar']);
        $this->repository->addAvailableInclude('reply', ['created_at']);
        $this->repository->addAvailableInclude('topic', ['title']);

        $data = $this->repository
            ->byUserId(Auth::id())
            ->autoWith()
            ->autoWithRootColumns(['id', 'type', 'body', 'topic_id', 'reply_id', 'created_at'])
            ->paginate(per_page());

        $this->user_repository->setUnreadMessagesCount(Auth::id(), 0);

        return $this->response()->paginator($data, new NotificationTransformer());
    }

    /**
     * 获取当前用户的未读消息数.
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function unreadMessagesCount()
    {
        $count = $this->user_repository->getUnreadMessagesCount();

        return response(compact('count'));
    }
}
