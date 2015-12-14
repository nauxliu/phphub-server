<?php
/**
 * Created by PhpStorm.
 * User: xuan
 * Date: 12/3/15
 * Time: 7:12 PM.
 */

namespace PHPHub\Transformers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use League\Fractal\TransformerAbstract;
use McCool\LaravelAutoPresenter\HasPresenter;

abstract class BaseTransformer extends TransformerAbstract
{
    /**
     * 要展示到接口的字段
     * @var array
     */
    protected $columns = [];

    /**
     * 仅仅需要,但是不直接展示到接口的字段
     * @var array
     */
    protected $only_select_columns = [];

    public function transform(Model $model)
    {
        $model_data = $this->modelData($model);

        if ($model instanceof HasPresenter) {
            $model = app('autopresenter')->decorate($model);
        }

        $data =  $this->transformData($model_data, $model);

        // 默认将 null 转换为空字符串
        if(!request()->has('real_null')){
            foreach($data as $key => $value){
                if(is_null($value)){
                    $data[$key] = '';
                }
            }
        }

        // 可统一转换 bool 值为字符串, 客户端要做存储时更好使用
        if(request()->has('str_bool')){
            foreach($data as $key => $value){
                if(is_bool($value)){
                    $data[$key] = $value === true ? 'true' : 'false';
                }
            }
        }

        return $data;
    }

    /**
     * 转换 model 为数组.
     *
     * @param Model $model
     *
     * @return array
     */
    public function modelData(Model $model)
    {
        $data = $model->toArray();

        if (!empty($this->columns)) {
            $data = array_only($data, $this->columns);
        }

        if (!empty($this->only_select_columns)) {
            $data = array_except($data, $this->only_select_columns);
        }

        return $data;
    }

    /**
     * 设置要返回到接口的字段
     * @param array $columns
     * @return array
     */
    public function setColumns(array $columns)
    {
        return $this->columns = $columns;
    }

    /**
     * 添加要返回到接口字段
     * @param array $columns
     * @return array
     */
    public function addColumns(array $columns)
    {
        return $this->columns = array_merge($this->columns, $columns);
    }

    /**
     * 计算需要使用到的字段
     * @return array
     */
    public function figureOutWhichUsed()
    {
        return array_merge($this->columns, $this->only_select_columns);
    }

    /**
     * 获取一个当前 Transformer 的实例
     *
     * @param array $available_includes 允许的引入项
     * @param array $add_columns 添加要返回到接口的字段
     * @return \Illuminate\Foundation\Application|mixed
     */
    public static function make(array $available_includes = [], array $add_columns = [])
    {
        $transformer = app(get_called_class());
        if(!empty($available_includes)){
            $transformer->availableIncludes = array_intersect($transformer->availableIncludes, $available_includes);
        }
        if(!empty($add_columns)){
            $transformer->addColumns($add_columns);
        }

        return $transformer;
    }

    abstract public function transformData(array $model, $model);
}
