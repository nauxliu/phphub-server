<?php

/**
 * Created by PhpStorm.
 * User: xuan
 * Date: 9/22/15
 * Time: 2:47 PM.
 */

/**
 * 获取每页数量.
 *
 * @param null $default
 *
 * @return String
 */
function per_page($default = null)
{
    $per_page = Input::get('per_page') ?: $default;

    return $per_page ?: config('api.default_per_page');
};

function cdn($file_path)
{
    $base_url = config('app.static_mirror_url') ?: config('app.url');

    return trim($base_url, '/').'/'.$file_path;
}
