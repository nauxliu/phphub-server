<?php

/**
 * 申请 access_token 或者刷新 access_token.
 */
$router->post('oauth/access_token', function () {
    return Response::json(Authorizer::issueAccessToken());
});

/*
 * 需要 login-token 认证获得的 access_token
 */
$router->group(['middleware' => ['oauth', 'oauth-user']], function ($router) {
    $router->get('me', 'UsersController@me');
});

/*
 * 需要 client_credentials 认证获得的 access_token
 */
$router->group(['middleware' => ['oauth', 'oauth-client']], function ($router) {
});

//TODO： 客户端还未完成认证，路由都先不用 token

// Topics
$router->resource('topics', 'TopicsController');
$router->get('topics/{id}/replies', 'RepliesController@indexByTopicId');

// Replies
$router->get('users/{id}/replies', 'RepliesController@indexByUserId');

// User
$router->resource('users', 'UsersController');
