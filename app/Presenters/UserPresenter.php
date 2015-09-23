<?php

namespace PHPHub\Presenters;

use PHPHub\Transformers\UserTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class UserPresenter.
 */
class UserPresenter extends FractalPresenter
{
    use HelpersTrait;

    /**
     * Transformer.
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new UserTransformer();
    }

    public function avatar()
    {
        return cdn('uploads/avatars/'.$this->getWrapObject()->avatar);
    }
}
