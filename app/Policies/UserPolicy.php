<?php

namespace PHPHub\Policies;

use PHPHub\User;

class UserPolicy
{
    public function update(User $user, User $model)
    {
        //TODO: 管理员有权限修改用户资料
        return $user->id === $model->id;
    }
}
