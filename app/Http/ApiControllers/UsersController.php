<?php

namespace PHPHub\Http\ApiControllers;

use Auth;
use PHPHub\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use PHPHub\Transformers\UserTransformer;

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
        //
    }
}
