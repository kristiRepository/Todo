<?php

$router->get('', 'AuthController@login@loggedIn');
$router->get('signup', 'AuthController@signup@loggedIn');
$router->post('register', 'AuthController@register@loggedIn');
$router->post('check', 'AuthController@check@loggedIn');
$router->get('main', 'TodoController@main');
$router->post('signout', 'AuthController@signout');
$router->post('add', 'TodoController@add');
$router->post('done', 'TodoController@done');
$router->post('edit', 'TodoController@edit');
$router->post('delete', 'TodoController@deletetask');