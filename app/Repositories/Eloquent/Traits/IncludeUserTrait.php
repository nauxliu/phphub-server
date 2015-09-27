<?php

/**
 * Created by PhpStorm.
 * User: xuan
 * Date: 9/25/15
 * Time: 8:09 AM.
 */
namespace PHPHub\Repositories\Eloquent\Traits;

use PHPHub\Transformers\IncludeManager\Includable;
use PHPHub\Transformers\IncludeManager\IncludeManager;
use PHPHub\User;

trait IncludeUserTrait
{
    /**
     * 使用 user_id 字段引入关联的用户.
     *
     * @param $default_columns
     */
    public function includeUser($default_columns)
    {
        $available_include = Includable::make('user')
            ->setDefaultColumns($default_columns)
            ->setAllowColumns(User::$includable)
            ->setForeignKey('user_id');

        app(IncludeManager::class)->add($available_include);
    }
}
