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
    private $notifications;
    /**
     * @var UserRepositoryInterface
     */
    private $users;

    /**
     * NotificationController constructor.
     *
     * @param NotificationRepositoryInterface $repository
     * @param UserRepositoryInterface         $user_repository
     */
    public function __construct(NotificationRepositoryInterface $repository, UserRepositoryInterface $user_repository)
    {
        $this->notifications = $repository;
        $this->users = $user_repository;
    }

    /**
     * 获取当前用户的通知消息.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->notifications->addAvailableInclude('from_user', ['name', 'avatar']);
        $this->notifications->addAvailableInclude('reply', ['created_at']);
        $this->notifications->addAvailableInclude('topic', ['title']);

        $data = $this->notifications
            ->userRecent(Auth::id())
            ->autoWith()
            ->autoWithRootColumns(['id', 'type', 'body', 'topic_id', 'reply_id', 'created_at'])
            ->paginate(per_page());

        $this->users->setUnreadMessagesCount(Auth::id(), 0);

        return $this->response()->paginator($data, new NotificationTransformer());
    }

    /**
     * 获取当前用户的未读消息数.
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function unreadMessagesCount()
    {
        $count = $this->users->getUnreadMessagesCount();

        return response(compact('count'));
    }
}
