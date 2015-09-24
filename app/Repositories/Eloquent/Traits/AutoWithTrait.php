<?php

/**
 * Created by PhpStorm.
 * User: xuan
 * Date: 9/22/15
 * Time: 12:06 AM.
 */
namespace PHPHub\Repositories\Eloquent\Traits;

use Input;
use PHPHub\Transformers\IncludeManager\IncludeManager;

trait AutoWithTrait
{
    /**
     * 用户请求引入字段
     * @var array
     */
    protected $param_columns = null;


    /**
     * 自动 with include 的关联.
     *
     * @return $this
     */
    public function autoWith()
    {
        $include_manager = app(IncludeManager::class);

        if(null == $this->param_columns){
            $this->param_columns = $this->parseColumnsParam();
        }

        foreach ($include_manager->getIncludableNames() as $include_name) {
            $include = $include_manager->getIncludable($include_name);
            $include->setColumns(array_get($this->param_columns, $include_name, []));

            // 没有传 $foreign_key 时不是 belongsTo 关系，不能走 withOnly，会获取不到数据
            if (!$include->isNested() && !$include->getForeignKey()) {
                $limit = $include->getLimit();
                $this->with([
                    $include->getRelation() => function ($query) use ($limit) {
                        $query->limit($limit);
                    }
                ]);
            } else {
                $this->withOnly($include->getRelation(), $include->figureOutWhichColumns());
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
        $include_manager = app(IncludeManager::class);
        $this->model = $this->model
            ->select(array_merge($columns, $include_manager->getForeignKeys()));
        return $this;
    }

    /**
     * 解析 columns 参数，用于指定 include 关联的字段
     * eg. ?include=user&columns=user(name,avatar,gender).
     *
     * @return array
     */
    private function parseColumnsParam()
    {
        $result = [];
        $items = explode(',', Input::get('columns'));

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
