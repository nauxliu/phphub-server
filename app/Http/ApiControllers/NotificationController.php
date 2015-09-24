<?php

namespace PHPHub\Http\ApiControllers;

use Illuminate\Http\Request;
use PHPHub\Http\Requests;
use PHPHub\Notification;
use PHPHub\Repositories\NotificationRepositoryInterface;
use PHPHub\Transformers\NotificationTransformer;
use PHPHub\User;

class NotificationController extends Controller
{
    /**
     * @var NotificationRepositoryInterface
     */
    private $repository;

    /**
     * NotificationController constructor.
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
        $this->repository->addIncludable('from_user', ['name', 'avatar'], User::$includable, 'from_user_id');

        $data = $this->repository
            ->skipPresenter()
            ->autoWith()
            ->paginate();

        return $this->response()->paginator($data, new NotificationTransformer());
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
