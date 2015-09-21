<?php

/**
 * Created by PhpStorm.
 * User: xuan
 * Date: 9/22/15
 * Time: 1:13 AM.
 */
namespace App\Repositories\TraitsInterface;

interface AutoWIthInterface
{
    public function addIncludable($include, array $default_columns, array $includable_columns, $foreign_key = null);

    /**
     * 自动 with include 的数据.
     *
     * @return $this
     */
    public function autoWith();
}
