<?php

/**
 * Created by PhpStorm.
 * User: xuan
 * Date: 9/22/15
 * Time: 12:06 AM.
 */
namespace PHPHub\Repositories\Eloquent\Traits;

use Exception;
use Input;
use PHPHub\Transformers\IncludeManager\IncludeManager;

trait AutoWithTrait
{
    /**
     * 用户请求引入字段.
     *
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

        $param_columns  = $this->parseColumnsParam();
        $which_includes = $include_manager->figureOutWhichIncludes();

        foreach ($which_includes as $include_name) {
            $include = $include_manager->getIncludable($include_name);
            $include->setColumns(array_get($param_columns, $include_name, []));

            // 嵌套节点会在父节点被解析的时候解析到
            if ($include->isNested()) {
                continue;
            } // 没有传 $foreign_key 时不是 belongsTo 关系，不能走 withOnly，会获取不到数据
            elseif (!$include->getForeignKey()) {
                $this->with([
                    $include->getRelation() => function ($query) use ($include, &$which_includes) {
                        $query->limit($include->getLimit());
                        // hasMany 可能会有子引入项，也自动 with
                        foreach ($include->getChildren() as $child_include) {
                            if (!in_array($child_include->getName(), $which_includes)) {
                                continue;
                            }
                            $name = explode('.', $child_include->getName());
                            $query->with(end($name));
                        }
                    },
                ]);
            } else {
                $this->withOnly($include->getRelation(), $include->figureOutWhichColumns());
            }
        }

        return $this;
    }

    /**
     * 添加一个可用的引入项.
     *
     * @param $name
     * @param $default_columns
     *
     * @return $this
     *
     * @throws Exception
     */
    public function addAvailableInclude($name, $default_columns)
    {
        $method_name = camel_case('include_'.str_replace('.', '_', $name));

        if (!method_exists($this, $method_name)) {
            throw new Exception("You should define $method_name in your repository");
        }

        call_user_func([$this, $method_name], $default_columns);

        return $this;
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
        $this->model     = $this->model
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
        if (null != $this->param_columns) {
            $this->param_columns;
        }
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

        return $this->param_columns = $result;
    }
}
