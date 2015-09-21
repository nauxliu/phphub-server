<?php
/**
 * Created by PhpStorm.
 * User: xuan
 * Date: 9/21/15
 * Time: 7:11 PM
 */

namespace App\Transformers\Traits;

use App\Transformers\UserTransformer;
use Illuminate\Database\Eloquent\Model;

trait IncludeUserTrait
{
    public function includeUser(Model $model, $field = 'user')
    {
        return $this->item($model->$field, new UserTransformer());
    }
}