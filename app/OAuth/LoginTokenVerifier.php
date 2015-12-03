<?php

/**
 * Created by PhpStorm.
 * User: xuan
 * Date: 9/22/15
 * Time: 9:12 PM.
 */
namespace PHPHub\OAuth;

use PHPHub\User;

class LoginTokenVerifier
{
    public function verify($github_name, $login_token)
    {
        $user = User::query()
            ->where(['github_name' => $github_name])
            ->first(['id', 'login_token']);

        if ($user->login_token === $login_token) {
            return $user->id;
        }

        return false;
    }
}
