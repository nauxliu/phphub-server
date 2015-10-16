<?php

namespace PHPHub\Http\ApiControllers;

use PHPHub\Repositories\LaunchScreenAdvertRepositoryInterface;
use PHPHub\Transformers\LaunchScreenAdvertTransformer;

/**
 * 客户端启动的首屏广告.
 *
 * Class LaunchScreenAdvertsController
 */
class LaunchScreenAdvertsController extends Controller
{
    /**
     * @var LaunchScreenAdvertRepositoryInterface
     */
    private $adverts;

    /**
     * TopicController constructor.
     *
     * @param LaunchScreenAdvertRepositoryInterface $repository
     */
    public function __construct(LaunchScreenAdvertRepositoryInterface $repository)
    {
        $this->adverts = $repository;
    }

    /**
     * 获取所有广告数据.
     */
    public function index()
    {
        $adverts = $this->adverts->all();

        return $this->response()->collection($adverts, new LaunchScreenAdvertTransformer());
    }
}
