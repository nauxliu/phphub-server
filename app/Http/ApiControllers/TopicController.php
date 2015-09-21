<?php

namespace App\Http\ApiControllers;

use App\Models\Topic;
use App\Presenters\TopicPresenter;
use App\Repositories\TopicRepository;
use App\Transformers\TopicTransformer;
use Illuminate\Http\Request;
use App\Http\Requests;
use Prettus\Repository\Presenter\ModelFractalPresenter;

class TopicController extends Controller
{
    /**
     * @var TopicRepository
     */
    private $repository;

    /**
     * TopicController constructor.
     * @param TopicRepository $repository
     */
    public function __construct(TopicRepository $repository)
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
        return $this->repository->paginate(15,
            ['id', 'title', 'is_excellent', 'reply_count', 'created_at', 'updated_at']);
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
