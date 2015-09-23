<?php


$router->post('oauth/access_token', function () {
    return Response::json(Authorizer::issueAccessToken());
});

$router->resource('topics', 'TopicsController');

$router->get('topics/{id}/replies', 'RepliesController@indexByTopicId');
