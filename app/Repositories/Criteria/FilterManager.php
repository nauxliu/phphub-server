<?php
/**
 * Created by PhpStorm.
 * User: xuan
 * Date: 10/23/15
 * Time: 10:39 AM.
 */
namespace PHPHub\Repositories\Criteria;

use Input;

class FilterManager
{
    protected static $added_filters = [];
    protected static $parsed_filters = [];

    /**
     * 获取应该应用的 filters.
     *
     * @return array
     */
    public static function get()
    {
        $filters = array_merge(self::$added_filters, self::parseRequest());

        return array_reverse(array_unique($filters));
    }

    /**
     * 解析请求的 filters.
     *
     * @return array
     */
    public static function parseRequest()
    {
        if (self::$parsed_filters !== []) {
            return self::$parsed_filters;
        }

        return self::$parsed_filters = explode(',', Input::get('filters'));
    }

    /**
     * 添加 filter.
     *
     * @param $filters
     */
    public static function addFilter($filters)
    {
        self::$added_filters = array_merge(self::$added_filters, (array) $filters);
    }
}
