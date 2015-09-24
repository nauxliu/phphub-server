<?php
/**
 * Created by PhpStorm.
 * User: xuan
 * Date: 9/24/15
 * Time: 12:08 PM
 */

namespace PHPHub\Transformers\IncludeManager;

use Dingo\Api\Http\Request;
use Dingo\Api\Transformer\Adapter\Fractal;
use Dingo\Api\Transformer\Binding;
use Dingo\Api\Contract\Transformer\Adapter;
use Illuminate\Contracts\Pagination\Paginator as IlluminatePaginator;

class TransformerLayer extends Fractal implements Adapter
{
    public function transform($response, $transformer, Binding $binding, Request $request)
    {
        // TODO: 过滤 include，仅允许当前接口允许的 include 项
        $this->parseFractalIncludes($request);

        $resource = $this->createResource($response, $transformer, $binding->getParameters());

        // If the response is a paginator then we'll create a new paginator
        // adapter for Laravel and set the paginator instance on our
        // collection resource.
        if ($response instanceof IlluminatePaginator) {
            $paginator = $this->createPaginatorAdapter($response);

            $resource->setPaginator($paginator);
        }

        foreach ($binding->getMeta() as $key => $value) {
            $resource->setMetaValue($key, $value);
        }

        $binding->fireCallback($resource, $this->fractal);

        return $this->fractal->createData($resource)->toArray();
    }
}