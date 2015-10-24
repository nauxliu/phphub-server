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

trait IncludeTopicTrait
{
    /**
     * 使用 user_id 字段引入关联的用户.
     *
     * @param $default_columns
     */
    public function includeTopic($default_columns)
    {
        $available_include = Includable::make('topic')
            ->setDefaultColumns($default_columns)
            ->setAllowColumns(User::$includable)
            ->withTrashed()
            ->setForeignKey('topic_id');

        app(IncludeManager::class)->add($available_include);
    }
}
