<?php

/**
 * Created by PhpStorm.
 * User: xuan
 * Date: 9/21/15
 * Time: 10:28 PM.
 */
namespace PHPHub\Presenters;

use Exception;

trait HelpersTrait
{
    protected $object = null;

    /**
     * Get Wrap Object.
     *
     * @return mixed
     */
    public function getWrapObject()
    {
        $this->checkObject();

        return $this->object;
    }

    /**
     * Set Model.
     *
     * @param mixed $object
     */
    public function setWrapObject($object)
    {
        $this->object = $object;
    }

    private function checkObject()
    {
        if (!$this->object) {
            throw new Exception('You need set a object to presenter');
        }
    }

    public function __get($name)
    {
        $this->checkObject();
        if (method_exists($this, $name)) {
            return call_user_func([$this, $name]);
        }

        return $this->object->$name;
    }

    public function __isset($name)
    {
        $this->checkObject();
        if (method_exists($this, $name) || method_exists($this->object, $name)) {
            return true;
        }

        return false;
    }

    public function __call($name, $arguments)
    {
        $this->checkObject();

        return call_user_func_array([$this->object, $name], $arguments);
    }
}
