<?php

namespace PHPHub\Transformers;

use PHPHub\Presenters\NodePresenter;

/**
 * Class NodeTransformer.
 */
class NodeTransformer extends BaseTransformer
{
    protected $columns = ['id', 'name', 'parent_node'];

    /**
     * Transform the \Node entity.
     *
     * @param array               $data
     * @param \Node|NodePresenter $model
     *
     * @return array
     */
    public function transformData(array $data, $model)
    {
        $data['parent_node'] = $model->parent_node ?: 0;

        return $data;
    }
}
