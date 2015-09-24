<?php
/**
 * Created by PhpStorm.
 * User: xuan
 * Date: 9/24/15
 * Time: 4:06 PM
 */

namespace PHPHub\Transformers\IncludeManager;


class IncludeManager
{
    private $includables = [];
    private $foreign_keys;

    /**
     * 添加一个可被引入的项
     *
     * @param Includable $includable
     */
    public function add(Includable $includable)
    {
        $this->includables[$includable->getName()] = $includable;
        $this->foreign_keys[] = $includable->getForeignKey();
    }

    /**
     * 按引入项的名称获取对象
     *
     * @param $name
     * @return Includable|null
     */
    public function getIncludable($name)
    {
        return array_get($this->includables, $name, null);
    }

    /**
     * 获取所有的引入项名称
     * @return array
     */
    public function getIncludableNames()
    {
        return array_keys($this->includables);
    }

    /**
     * 获取所有引入项的外键
     * @return mixed
     */
    public function getForeignKeys()
    {
        return $this->foreign_keys;
    }
}