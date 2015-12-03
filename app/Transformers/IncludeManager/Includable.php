<?php

/**
 * Created by PhpStorm.
 * User: xuan
 * Date: 9/24/15
 * Time: 4:07 PM.
 */
namespace PHPHub\Transformers\IncludeManager;

class Includable
{
    private $default_columns = [];
    private $allow_columns = [];
    private $columns = [];
    private $relation;
    private $nested = false;
    private $name;
    private $foreign_key;
    private $limit;
    private $parent_name;
    private $children = [];
    private $with_trashed = false;

    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * 获取这个引入项的字段.
     *
     * @return array
     *
     * @throws \Exception
     */
    public function getColumns()
    {
        if (! $this->columns) {
            throw new \Exception("You must set includable's columns");
        }

        return $this->columns;
    }

    /**
     * 设置这个引入项的字段.
     *
     * @param array $columns
     *
     * @return $this
     */
    public function setColumns($columns)
    {
        $this->columns = $columns;

        return $this;
    }

    /**
     * 获取这个引入项默认引入的字段.
     *
     * @return array
     *
     * @throws \Exception
     */
    public function getDefaultColumns()
    {
        if (! $this->default_columns) {
            throw new \Exception("You must set includable's default columns");
        }

        return $this->default_columns;
    }

    /**
     * 设置这个引入项默认引入的字段.
     *
     * @param array|string $default_columns
     *
     * @return $this
     */
    public function setDefaultColumns($default_columns)
    {
        $this->default_columns = (array) $default_columns;

        return $this;
    }

    /**
     * 获取这个引入项的名称.
     *
     * @return string
     *
     * @throws \Exception
     */
    public function getName()
    {
        if (! $this->name) {
            throw new \Exception("You must set includable's name");
        }

        return $this->name;
    }

    /**
     * 设置这个引入项的字段.
     *
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * 获取这个引入项关联的外键，仅 belongTo 关系需要设置.
     *
     * @return string
     *
     * @throws \Exception
     */
    public function getForeignKey()
    {
        if (! $this->nested && ! $this->foreign_key && ! $this->limit) {
            throw new \Exception("You must set includable's limit or foreign key");
        }

        return $this->foreign_key;
    }

    /**
     * 获取这个引入项关联的外键.
     *
     * @param string $foreign_key
     *
     * @return $this
     */
    public function setForeignKey($foreign_key)
    {
        $this->foreign_key = $foreign_key;

        return $this;
    }

    /**
     * 获取引入条数限制.
     *
     * @return int
     *
     * @throws \Exception
     */
    public function getLimit()
    {
        if (! $this->foreign_key && ! $this->limit) {
            throw new \Exception("You must set includable's limit or foreign key");
        }

        return $this->limit;
    }

    /**
     * 设置引入条数限制, 仅对多关系时设置(hasMany, belongsToMany, etc..).
     *
     * @param int $limit
     *
     * @return $this
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * 获取允许被客户端引入的字段.
     *
     * @return array
     */
    public function getAllowColumns()
    {
        return $this->allow_columns;
    }

    /**
     * 设置允许被客户端引入的字段.
     *
     * @param mixed $allow_columns
     *
     * @return $this
     */
    public function setAllowColumns(array $allow_columns)
    {
        $this->allow_columns = $allow_columns;

        return $this;
    }

    /**
     * 计算出需要哪些字段.
     */
    public function figureOutWhichColumns()
    {
        $legal_columns = array_intersect($this->columns, $this->allow_columns);

        return array_merge($legal_columns, $this->default_columns);
    }

    /**
     * 获取对应于 model 的关联方法.
     *
     * @return string
     */
    public function getRelation()
    {
        return $this->relation ?: camel_case($this->name);
    }

    /**
     * 设置对应于 model 的关联方法.
     *
     * @param mixed $relation
     *
     * @return $this
     */
    public function setRelation($relation)
    {
        $this->relation = $relation;

        return $this;
    }

    /**
     * 设置这个引入项目是否是嵌套的.
     *
     * @param $parent string 父引入项名
     *
     * @return $this
     */
    public function nested($parent)
    {
        $this->parent_name = $parent;
        $this->nested = true;

        return $this;
    }

    /**
     * 同时查询软删除的数据.
     *
     * @return $this
     */
    public function withTrashed()
    {
        $this->with_trashed = true;

        return $this;
    }

    /**
     * 是否要查询软删除的数据.
     *
     * @return bool
     */
    public function isWithTrashed()
    {
        return $this->with_trashed;
    }

    /**
     * 获取这个引入项目是否是嵌套的.
     *
     * @return bool
     */
    public function isNested()
    {
        return $this->nested;
    }

    /**
     * 获取一个新的自身的实例.
     *
     * @param $name
     *
     * @return Includable
     */
    public static function make($name)
    {
        return new self($name);
    }

    /**
     * 获取父引入项名.
     *
     * @return mixed
     */
    public function getParentName()
    {
        return $this->parent_name;
    }

    /**
     * 获取所有子引入项.
     *
     * @return Includable[]
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * 添加一个子引入项目.
     *
     * @param mixed $children
     */
    public function addChildren(Includable $children)
    {
        $this->children[$children->getName()] = $children;
    }
}
