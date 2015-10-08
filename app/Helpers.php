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
    $max_per_page = config('api.max_per_page');
    $per_page     = (Input::get('per_page') ?: $default) ?: config('api.default_per_page');

    return (int) ($per_page < $max_per_page ? $per_page : $max_per_page);
};

/**
 * 使用 cdn 镜像获取本地资源的加速连接.
 *
 * @param $file_path
 *
 * @return string
 */
function cdn($file_path)
{
    $base_url = config('app.static_mirror_url') ?: config('app.url');

    return trim($base_url, '/').'/'.$file_path;
}

/**
 * 获取 elixir 的 CDN 连接.
 *
 * @param $file
 *
 * @return string
 */
function cdn_elixir($file)
{
    $cdn_url = config('app.static_mirror_url');

    return $cdn_url ? trim($cdn_url, '/').elixir($file) : elixir($file);
}

/**
 * 在 Repository Criteria 中应用 filter.
 *
 * @param array|string $filters
 */
function add_filter($filters)
{
    $filters = (array) $filters;
    Input::merge(['filter' => Input::get('filter').','.implode(',', $filters)]);
}
