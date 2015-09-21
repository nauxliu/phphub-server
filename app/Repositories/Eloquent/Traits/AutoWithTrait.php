<?php
/**
 * Created by PhpStorm.
 * User: xuan
 * Date: 9/22/15
 * Time: 12:06 AM
 */

namespace App\Repositories\Eloquent\Traits;


use Input;

trait AutoWithTrait
{
    protected $auto_with = [];
    protected $foreign_keys = [];

    /**
     * 添加自动 With 规则
     *
     * @param $include
     * @param array $default_columns 默认字段
     * @param array $includable_columns 可允许字段
     * @param null $foreign_key belongsTo 关系的外键，Has 关系的可不填
     */
    public function addIncludable($include, array $default_columns, array $includable_columns, $foreign_key = null)
    {
        $this->auto_with[$include] = compact('default_columns', 'includable_columns', 'foreign_key');

        if($foreign_key){
            $this->foreign_keys[] = $foreign_key;
        }
    }

    /**
     * 自动 with include 的关联
     *
     * @return $this
     */
    public function autoWith()
    {
        $includes = explode(',', Input::get('include'));
        $columns = $this->parseColumns();

        foreach ($includes as $include) {
            if (!array_key_exists($include, $this->auto_with)) {
                continue;
            }

            $default_columns = array_get($this->auto_with, $include, ['default_columns' => []])['default_columns'];
            $manual_columns = array_get($columns, $include, []);
            $relation = camel_case($include);

            $this->withOnly($relation, array_filter(array_merge($default_columns, $manual_columns)));
        }

        return $this;
    }

    /**
     * 设置数据要查询的字段
     * @param $columns
     * @return $this
     */
    public function autoWithRootColumns($columns){
        $this->model = $this->model->select(array_merge($columns, $this->foreign_keys));
        return $this;
    }

    /**
     * 解析 columns 参数，用于指定 include 关联的字段
     *
     * @return array
     */
    private function parseColumns()
    {
        $result = [];
        $items = explode(',', Input::get('columns'));

        foreach($items as $item){
            $arr = explode('(', $item);
            if(count($arr) != 2){continue;}

            list($include, $columns_str) = $arr;

            $result[$include] = explode(':', trim($columns_str, ')'));
        }

        return $result;
    }

}