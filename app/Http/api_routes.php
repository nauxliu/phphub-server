<?php

use Dingo\Api\Routing\Router;

$router = app('api.router');

/*
 * 申请 access_token 或者刷新 access_token.
 */
$router->post('oauth/access_token', function () {
    return Response::json(Authorizer::issueAccessToken());
});

/*
 * 需要 login-token 认证获得的 access_token
 */
$router->group(['middleware' => ['api.auth', 'oauth-user']], function (Router $router) {
    //Users
    $router->get('me', 'UsersController@me');
    $router->put('users/{id}', 'UsersController@update');

    //Topics
    $router->post('topics', 'TopicsController@store');
    $router->delete('topics/{id}', 'TopicsController@delete');
    $router->post('topics/{id}/vote-up', 'TopicsController@voteUp');
    $router->post('topics/{id}/vote-down', 'TopicsController@voteDown');

    //Replies
    $router->post('replies', 'RepliesController@store');

    //Notifications
    $router->get('me/notifications', 'NotificationController@index');
    $router->get('me/notifications/count', 'NotificationController@unreadMessagesCount');
});

/*
 * 需要 client_credentials 认证获得的 access_token
 */
$router->group(['middleware' => ['oauth', 'oauth-client']], function (Router $router) {
    //Topics
    $router->get('topics', 'TopicsController@index');
    $router->get('topics/{id}', 'TopicsController@show');
    $router->get('user/{id}/favorite/topics', 'TopicsController@indexByUserFavorite');
    $router->get('user/{id}/attention/topics', 'TopicsController@indexByUserAttention');
    $router->get('user/{id}/topics', 'TopicsController@indexByUserId');
    $router->get('node/{id}/topics', 'TopicsController@indexByNodeId');

    //Web Views
    $router->get('topics/{id}/web_view',
        ['as' => 'topic.web_view', 'uses' => 'TopicsController@showWebView']);

    //Nodes
    $router->get('nodes', 'NodesController@index');

    //Replies
    $router->get('topics/{id}/replies', 'RepliesController@indexByTopicId');
    $router->get('users/{id}/replies', 'RepliesController@indexByUserId');

    //Users
    $router->get('users/{id}', 'UsersController@show');
});
