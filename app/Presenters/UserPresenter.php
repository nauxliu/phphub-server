<?php

namespace PHPHub\Presenters;

use McCool\LaravelAutoPresenter\BasePresenter;

/**
 * Class UserPresenter.
 */
class UserPresenter extends BasePresenter
{
    public function avatar()
    {
        return cdn('uploads/avatars/'.$this->getWrappedObject()->avatar);
    }
}
