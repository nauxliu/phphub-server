<?php

namespace App\Presenters;

use App\Transformers\TopicTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TopicPresenter.
 */
class TopicPresenter extends FractalPresenter
{
    use HelpersTrait;

    /**
     * Transformer.
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TopicTransformer();
    }
}
