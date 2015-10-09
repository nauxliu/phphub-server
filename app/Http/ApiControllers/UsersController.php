<?php

namespace PHPHub\Http\ApiControllers;

use Auth;
use Dingo\Api\Exception\UpdateResourceFailedException;
use Gate;
use PHPHub\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use PHPHub\Transformers\UserTransformer;
use PHPHub\User;
use Prettus\Validator\Exceptions\ValidatorException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class UsersController extends Controller
{
    /**
     * @var UserRepositoryInterface
     */
    private $users;

    /**
     * TopicController constructor.
     *
     * @param UserRepositoryInterface $repository
     */
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->users = $repository;
    }

    /**
     * 获取当前用户资料.
     */
    public function me()
    {
        $data = $this->users
            ->autoWithRootColumns(User::$includable)
            ->find(Auth::id());

        return $this->response()->item($data, new UserTransformer());
    }

    /**
     * 获取指定用户的资料.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->users
            ->autoWithRootColumns(User::$includable)
            ->find($id);

        return $this->response()->item($data, new UserTransformer());
    }

    /**
     * 更新指定用户的资料.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = $this->users->find($id);

        if (Gate::denies('update', $user)) {
            throw new AccessDeniedHttpException();
        }

        try {
            $user = $this->users->update($request->all(), $id);

            return $this->response()->item($user, new UserTransformer());
        } catch (ValidatorException $e) {
            throw new UpdateResourceFailedException('Could not update user.', $e->getMessageBag()->all());
        }
    }
}
