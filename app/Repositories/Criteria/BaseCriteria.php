<?php

namespace PHPHub\Repositories\Criteria;

use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Created by PhpStorm.
 * User: xuan
 * Date: 9/22/15
 * Time: 8:05 AM.
 */
abstract class BaseCriteria extends RequestCriteria
{
    public function apply($builder, RepositoryInterface $repository)
    {
        $fieldsSearchable = $repository->getFieldsSearchable();
        $search = $this->request->get(config('repository.criteria.params.search', 'search'), null);
        $searchFields = $this->request->get(config('repository.criteria.params.searchFields', 'searchFields'), null);
        $filter = $this->request->get(config('repository.criteria.params.filter', 'filter'), null);
        $orderBy = $this->request->get(config('repository.criteria.params.orderBy', 'orderBy'), null);
        $sortedBy = $this->request->get(config('repository.criteria.params.sortedBy', 'sortedBy'), 'asc');
        $sortedBy = ! empty($sortedBy) ? $sortedBy : 'asc';

        if ($search && is_array($fieldsSearchable) && count($fieldsSearchable)) {
            $searchFields = is_array($searchFields) || is_null($searchFields) ? $searchFields : explode(';',
                $searchFields);
            $fields = $this->parserFieldsSearch($fieldsSearchable, $searchFields);
            $isFirstField = true;
            $searchData = $this->parserSearchData($search);
            $search = $this->parserSearchValue($search);
            $modelForceAndWhere = false;

            $builder = $builder->where(function ($query) use (
                $fields,
                $search,
                $searchData,
                $isFirstField,
                $modelForceAndWhere
            ) {
                foreach ($fields as $field => $condition) {
                    if (is_numeric($field)) {
                        $field = $condition;
                        $condition = '=';
                    }

                    $value = null;

                    $condition = trim(strtolower($condition));

                    if (isset($searchData[$field])) {
                        $value = $condition === 'like' ? "%{$searchData[$field]}%" : $searchData[$field];
                    } else {
                        if (! is_null($search)) {
                            $value = $condition === 'like' ? "%{$search}%" : $search;
                        }
                    }

                    if ($isFirstField || $modelForceAndWhere) {
                        if (! is_null($value)) {
                            $query->where($field, $condition, $value);
                            $isFirstField = false;
                        }
                    } else {
                        if (! is_null($value)) {
                            $query->orWhere($field, $condition, $value);
                        }
                    }
                }
            });
        }

        if (isset($orderBy) && in_array(strtolower($sortedBy), ['asc', 'desc'])) {
            $builder = $builder->orderBy($orderBy, $sortedBy);
        }

        foreach (FilterManager::get() as $filter) {
            // eg. filter 'hot' 会调用方法 'filterHot'
            $method_name = camel_case('filter_'.$filter);
            if (method_exists($this, $method_name)) {
                $builder = call_user_func([$this, $method_name], $builder);
            }
        }

        return $builder;
    }
}
