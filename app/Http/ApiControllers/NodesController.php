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
        $data = $this->nodes->all(['id', 'name', 'parent_node']);

        return $this->response()->collection($data, new NodeTransformer());
    }
}
