<?php

namespace PHPHub\Presenters;

use PHPHub\Transformers\NotificationTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class NotificationPresenter.
 */
class NotificationPresenter extends FractalPresenter
{
    use HelpersTrait;

    /**
     * Transformer.
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new NotificationTransformer();
    }
}
