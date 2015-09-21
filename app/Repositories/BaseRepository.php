<?php
/**
 * Created by PhpStorm.
 * User: xuan
 * Date: 9/21/15
 * Time: 6:42 PM
 */

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

interface BaseRepository extends RepositoryInterface
{
    /**
     * Load relations and specific columns.
     *
     * @param array|string $relations
     * @param null $columns
     * @return $this
     */
    public function withOnly($relations, $columns = null);
}