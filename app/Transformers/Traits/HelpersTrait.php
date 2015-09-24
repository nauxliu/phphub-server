<?php

/**
 * Created by PhpStorm.
 * User: xuan
 * Date: 9/21/15
 * Time: 7:17 PM.
 */
namespace PHPHub\Transformers\Traits;

use Prettus\Repository\Contracts\PresenterInterface;
use Prettus\Repository\Exceptions\RepositoryException;

trait HelpersTrait
{
    /**
     * Transform the entity.
     *
     * @param $model
     *
     * @return array
     */
    public function transform($model)
    {
        if ($model instanceof PresenterInterface) {
            $presenter = app($model->present(null));
            if (!$presenter instanceof PresenterInterface) {
                throw new RepositoryException("Class {$presenter} must be an instance of Prettus\\Repository\\Contracts\\PresenterInterface");
            }
            if (method_exists($presenter, 'setWrapObject')) {
                $presenter->setWrapObject($model);
                $model = $presenter;
            }
        }

        $data = array_only($this->transformData($model), array_keys($model->toArray()));

        // 在 transformData 中使用 toArray 后，时间会丢失时区等信息
        if(isset($model->created_at)){
            $data['created_at'] = $model->created_at;
        }
        if($model->updated_at){
            $data['updated_at'] = $model->updated_at;
        }

        return $data;
    }
}
