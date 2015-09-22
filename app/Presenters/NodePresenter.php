<?php

namespace App\Presenters;

use App\Transformers\NodeTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class NodePresenter.
 */
class NodePresenter extends FractalPresenter
{
    /**
     * Transformer.
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new NodeTransformer();
    }
}
