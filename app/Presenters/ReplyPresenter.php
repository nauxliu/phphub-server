<?php

namespace App\Presenters;

use App\Transformers\ReplyTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ReplyPresenter.
 */
class ReplyPresenter extends FractalPresenter
{
    use HelpersTrait;

    /**
     * Transformer.
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ReplyTransformer();
    }
}
