<?php

namespace App\Presenters;

use App\Transformers\TopicTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TopicPresenter
 *
 * @package namespace App\Presenters;
 */
class TopicPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TopicTransformer();
    }
}
