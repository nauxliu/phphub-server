<?php

/**
 * WithOnlyInterface.php.
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
namespace PHPHub\Repositories\TraitsInterface;

/**
 * Interface WithOnlyInterface.
 */
interface WithOnlyInterface
{
    /**
     * Load relations and specific columns.
     *
     * @param array|string $relations
     * @param null         $columns
     *
     * @return $this
     */
    public function withOnly($relations, $columns = null);
}
