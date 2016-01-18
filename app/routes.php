<?php

$router = \Kernel\Application::getRouter();

$router->get('/', 'Controllers\UserController@index');
$router->get('register', 'Controllers\UserController@registerForm');
$router->post('register', 'Controllers\UserController@register');
$router->get('register_done', 'Controllers\UserController@registerDone');
$router->get('login', 'Controllers\UserController@loginForm');
$router->post('login', 'Controllers\UserController@login');
$router->get('logout', 'Controllers\UserController@logout');