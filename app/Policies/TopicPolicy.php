<?php

namespace PHPHub\Policies;

use PHPHub\Topic;
use PHPHub\User;

class TopicPolicy
{
    public function delete(User $user, Topic $topic)
    {
        //TODO: 管理员有权删除所有帖子
        return $user->id === $topic->user_id;
    }
}
