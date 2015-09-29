<?php

namespace PHPHub\Http\ApiControllers;

use Auth;
use Dingo\Api\Exception\UpdateResourceFailedException;
use Gate;
use PHPHub\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use PHPHub\Transformers\UserTransformer;
use Prettus\Validator\Exceptions\ValidatorException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class UsersController extends Controller
{
    /**
     * @var UserRepositoryInterface
     */
    private $repository;

    /**
     * TopicController constructor.
     *
     * @param UserRepositoryInterface $repository
     */
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * 获取当前用户资料.
     */
    public function me()
    {
        return $this->show(Auth::id());
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
        $data = $this->repository
            ->autoWithRootColumns(['id', 'name', 'avatar', 'is_banned'])
            ->find($id);

        return $this->response()->item($data, new UserTransformer());
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
        $user = $this->repository->find($id);

        if (Gate::denies('update', $user)) {
            throw new AccessDeniedHttpException();
        }

        try {
            $user = $this->repository->update($request->all(), $id);

            return $this->response()->item($user, new UserTransformer());
        } catch (ValidatorException $e) {
            throw new UpdateResourceFailedException('Could not update user.', $e->getMessageBag()->all());
        }
    }
}
