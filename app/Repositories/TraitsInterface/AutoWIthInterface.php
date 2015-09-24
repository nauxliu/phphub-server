<?php

/**
 * Created by PhpStorm.
 * User: xuan
 * Date: 9/22/15
 * Time: 1:13 AM.
 */
namespace PHPHub\Repositories\TraitsInterface;

interface AutoWIthInterface
{

    /**
     * 自动 with include 的数据.
     *
     * @return $this
     */
    public function autoWith();
}
