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
     * 根节点的字段.
     *
     * @var array
     */
    protected $param_root_columns = [];

    /**
     * 自动 with include 的关联.
     *
     * @return $this
     */
    public function autoWith()
    {
        $include_manager = app(IncludeManager::class);

        $param_columns = $this->parseColumnsParam();
        $which_includes = $include_manager->figureOutWhichIncludes();

        foreach ($which_includes as $include_name) {
            $include = $include_manager->getIncludable($include_name);
            $include->setColumns(array_get($param_columns, $include_name, []));

            if (! $include->getForeignKey()) {
                $this->with($include->getRelation());
            } else {
                $this->withOnly($include->getRelation(), $include->figureOutWhichColumns(), $include->isWithTrashed());
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

        if (! method_exists($this, $method_name)) {
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
        $this->parseColumnsParam();

        $include_manager = app(IncludeManager::class);
        $this->model = $this->model
            ->select(array_merge($this->param_root_columns, $columns, $include_manager->getForeignKeys()));

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
        if (null !== $this->param_columns) {
            $this->param_columns;
        }
        $result = [];
        $items = explode(',', Input::get('columns'));

        foreach ($items as $item) {
            $arr = explode('(', $item);
            if (count($arr) !== 2) {
                continue;
            }

            list($include, $columns_str) = $arr;

            $result[$include] = explode(':', trim($columns_str, ')'));
        }

        $this->param_root_columns = array_get($result, 'root', []);

        return $this->param_columns = array_except($result, ['root']);
    }
}
