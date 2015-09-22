<?php

$router->resource('topics', 'TopicsController');

$router->get('topics/{id}/replies', 'RepliesController@indexByTopicId');
