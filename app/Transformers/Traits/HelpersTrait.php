<?php
/**
 * Created by PhpStorm.
 * User: xuan
 * Date: 9/21/15
 * Time: 7:17 PM
 */

namespace App\Transformers\Traits;

use Prettus\Repository\Contracts\PresenterInterface;
use Prettus\Repository\Exceptions\RepositoryException;

trait HelpersTrait
{
    /**
     * Transform the entity
     * @param $model
     * @return array
     */
    public function transform($model)
    {
        if($model instanceof PresenterInterface){
            $presenter = app($model->present(null));
            if (!$presenter instanceof PresenterInterface ) {
                throw new RepositoryException("Class {$presenter} must be an instance of Prettus\\Repository\\Contracts\\PresenterInterface");
            }
            if(method_exists($presenter, 'setWrapObject')){
                $presenter->setWrapObject($model);
                $model = $presenter;
            }
        }

        return array_only($this->transformData($model), array_keys($model->toArray()));
    }
}