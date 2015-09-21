<?php
/**
 * RepositoryInterface.php
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

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Interface RepositoryInterface.
 */
interface RepositoryInterface extends PrettusRepositoryInterface, WithOnlyInterface
{

}