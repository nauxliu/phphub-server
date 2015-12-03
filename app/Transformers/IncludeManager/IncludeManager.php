<?php

/**
 * Created by PhpStorm.
 * User: xuan
 * Date: 9/24/15
 * Time: 4:06 PM.
 */
namespace PHPHub\Transformers\IncludeManager;

use Exception;
use Input;

class IncludeManager
{
    private $available_includes = [];
    private $foreign_keys = [];
    private $includes = null;

    /**
     * 添加一个可被引入的项.
     *
     * @param Includable $includable
     *
     * @throws Exception
     */
    public function add(Includable $includable)
    {
        if ($includable->isNested()) {
            $parent_includable = $this->getIncludable($includable->getParentName());
            if (null === $parent_includable) {
                throw new Exception('You must define includable '.$includable->getParentName());
            }
            $parent_includable->addChildren($includable);
        }
        $this->available_includes[$includable->getName()] = $includable;
        $this->foreign_keys[$includable->getName()] = $includable->getForeignKey();
    }

    /**
     * 按引入项的名称获取对象
     *
     * @param $name
     *
     * @return Includable|null
     */
    public function getIncludable($name)
    {
        return array_get($this->available_includes, $name, null);
    }

    /**
     * 获取所有的引入项名称.
     *
     * @return array
     */
    public function getAvailableIncludableNames()
    {
        return array_keys($this->available_includes);
    }

    /**
     * 获取需要的引入项的外键.
     *
     * @return mixed
     */
    public function getForeignKeys()
    {
        return array_only($this->foreign_keys, $this->figureOutWhichIncludes());
    }

    /**
     * 计算出需要那些引入项.
     */
    public function figureOutWhichIncludes()
    {
        return array_intersect($this->parseIncludes(), $this->getAvailableIncludableNames());
    }

    /**
     * 解析客户端的 include 参数.
     *
     * @return array
     */
    public function parseIncludes()
    {
        if ($this->includes === null) {
            return $this->includes = explode(',', Input::get('include'));
        }

        return $this->includes;
    }
}
