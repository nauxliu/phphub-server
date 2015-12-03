<?php

namespace PHPHub\Http\Controllers;

use PHPHub\Jobs\GenerateUsersLoginToken;
use PHPHub\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use QrCode;

class UserController extends Controller
{
    /**
     * @var UserRepositoryInterface
     */
    private $repository;

    /**
     * UserController constructor.
     *
     * @param UserRepositoryInterface $repository
     */
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * 获取用户登录 QR.
     *
     * @param $user_id  用户 ID
     *
     * @return \Illuminate\Http\Response
     */
    public function getLoginQR($user_id)
    {
        //TODO: 临时接口，待用户登录做了之后将 QR 生成到本地用 cdn 连接返回
        $login_token = $this->repository->skipPresenter()->find($user_id)->login_token;

        if (! $login_token) {
            $login_token = $this->dispatch(new GenerateUsersLoginToken($user_id));
        }

        return QrCode::size(200)
            ->margin(0)
            ->generate($login_token);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
