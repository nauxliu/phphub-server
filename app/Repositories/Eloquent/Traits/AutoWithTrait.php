<?php

/**
 * Created by PhpStorm.
 * User: xuan
 * Date: 9/22/15
 * Time: 12:06 AM.
 */
namespace App\Repositories\Eloquent\Traits;

use Input;

trait AutoWithTrait
{
    protected $auto_with    = [];
    protected $foreign_keys = [];

    /**
     * 添加自动 With 规则.
     *
     * @param $include
     * @param array $default_columns    默认字段
     * @param array $includable_columns 可允许字段
     * @param null  $foreign_key        只有 belongsTo 关联需要传
     * @param null  $limit              HasMany 关系是需要传，
     */
    public function addIncludable($include, array $default_columns, array $includable_columns, $foreign_key = null, $limit = null)
    {
        $limit                     = $limit ?: per_page();
        $this->auto_with[$include] = compact('default_columns', 'includable_columns', 'foreign_key', 'limit');

        if ($foreign_key) {
            $this->foreign_keys[] = $foreign_key;
        }
    }

    /**
     * 自动 with include 的关联.
     *
     * @return $this
     */
    public function autoWith()
    {
        $includes = explode(',', Input::get('include'));
        $columns  = $this->parseColumns();

        foreach ($includes as $include) {
            if (!array_key_exists($include, $this->auto_with)) {
                continue;
            }

            $default_columns = $this->getAutoWithConfig($include, 'default_columns');
            $foreign_key     = $this->getAutoWithConfig($include, 'foreign_key');
            $limit           = $this->getAutoWithConfig($include, 'limit');
            $manual_columns  = array_get($columns, $include, []);
            $relation        = camel_case($include);

            // 没有传 $foreign_key 时不是 belongsTo 关系，不能走 withOnly，会获取不到数据
            if (!$foreign_key) {
                $this->with([$relation => function ($query) use ($limit) {$query->limit($limit);}]);
            } else {
                $this->withOnly($relation, array_filter(array_merge($default_columns, $manual_columns)));
            }
        }

        return $this;
    }

    /**
     * @param $include
     * @param $key
     *
     * @return mixed
     */
    public function getAutoWithConfig($include, $key)
    {
        $configs = array_get($this->auto_with, $include, []);

        return array_get($configs, $key);
    }

    /**
     * 设置数据要查询的字段,自动绑定 include 关联的外键.
     *
     * @param $columns
     *
     * @return $this
     */
    public function autoWithRootColumns($columns)
    {
        $this->model = $this->model->select(array_merge($columns, $this->foreign_keys));

        return $this;
    }

    /**
     * 解析 columns 参数，用于指定 include 关联的字段
     * eg. ?include=user&columns=user(name,avatar,gender).
     *
     * @return array
     */
    private function parseColumns()
    {
        $result = [];
        $items  = explode(',', Input::get('columns'));

        foreach ($items as $item) {
            $arr = explode('(', $item);
            if (count($arr) != 2) {
                continue;
            }

            list($include, $columns_str) = $arr;

            $result[$include] = explode(':', trim($columns_str, ')'));
        }

        return $result;
    }
}
