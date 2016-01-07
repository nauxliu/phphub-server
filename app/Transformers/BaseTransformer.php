<?php
/**
 * Created by PhpStorm.
 * User: xuan
 * Date: 12/3/15
 * Time: 7:12 PM.
 */
namespace PHPHub\Transformers;

use Illuminate\Database\Eloquent\Model;
use League\Fractal\TransformerAbstract;

abstract class BaseTransformer extends TransformerAbstract
{
    public function transform(Model $model)
    {
        if ($model instanceof HasPresenter) {
            $model = app('autopresenter')->decorate($model);
        }

        $transformData = $this->transformData($model);

        $data = array_filter($transformData, function ($v) {
            if (is_null($v)) {
                return false;
            }

            return true;
        });

        // 转换 null 字段为空字符串
        foreach (array_keys($model->toArray()) as $key) {
            if (! isset($data[$key])) {
                $data[$key] = '';
                continue;
            }
            if (is_null($data[$key])) {
                $data[$key] = '';
            }
        }

        return $data;
    }

    abstract public function transformData($model);
}
