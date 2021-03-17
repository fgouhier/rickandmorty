<?php

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('character/{id}', 'CharacterController@show');

$router->post('character', 'CharacterController@create');

$router->patch('character/{id}', 'CharacterController@update');