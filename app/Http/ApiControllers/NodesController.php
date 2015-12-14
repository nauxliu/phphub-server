<?php

namespace PHPHub\Http\ApiControllers;

use PHPHub\Repositories\NodeRepositoryInterface;
use PHPHub\Transformers\NodeTransformer;

class NodesController extends Controller
{
    /**
     * @var NodeRepositoryInterface
     */
    private $nodes;

    /**
     * TopicController constructor.
     *
     * @param NodeRepositoryInterface $repository
     */
    public function __construct(NodeRepositoryInterface $repository)
    {
        $this->nodes = $repository;
    }

    /**
     * 获取节点列表.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transformer = NodeTransformer::make();

        $data = $this->nodes->all($transformer->figureOutWhichUsed());

        return $this->response()->collection($data, $transformer);
    }
}
