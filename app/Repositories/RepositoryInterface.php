<?php

/**
 * RepositoryInterface.php.
 *
 * Part of phphub-server.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author    overtrue <i@overtrue.me>
 * @copyright 2015 phphub.org
 *
 * @link      https://github.com/phphub/phphub-server
 * @link      http://overtrue.me
 */
namespace PHPHub\Repositories;

use PHPHub\Repositories\TraitsInterface\AutoWIthInterface;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;
use PHPHub\Repositories\TraitsInterface\WithOnlyInterface;

/**
 * Interface RepositoryInterface.
 */
interface RepositoryInterface extends PrettusRepositoryInterface,
    WithOnlyInterface,
    AutoWIthInterface
{
    /**
     * whereIn 查询并按照数组内数据排序.
     *
     * @param array  $data
     * @param string $column
     *
     * @return $this
     */
    public function whereInAndOrderBy(array $data, $column = 'id');
}
