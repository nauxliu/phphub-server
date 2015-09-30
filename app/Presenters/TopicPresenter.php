<?php

namespace PHPHub\Presenters;

use McCool\LaravelAutoPresenter\BasePresenter;

/**
 * Class TopicPresenter.
 */
class TopicPresenter extends BasePresenter
{
    public function title()
    {
        return app('auto-correct')->convert($this->wrappedObject->title);
    }
}