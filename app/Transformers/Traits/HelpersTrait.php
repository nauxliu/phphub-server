<?php
/**
 * Created by PhpStorm.
 * User: xuan
 * Date: 9/21/15
 * Time: 7:17 PM
 */

namespace App\Transformers\Traits;

use Prettus\Repository\Contracts\PresenterInterface;

trait HelpersTrait
{
    /**
     * Transform the entity
     * @param $model
     * @return array
     */
    public function transform($model)
    {
        return array_only($this->transformData($model), array_keys($model->toArray()));
    }
}