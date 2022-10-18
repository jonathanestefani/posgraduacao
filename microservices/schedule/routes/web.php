<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/schedules', [ 'uses' => 'ScheduleController@index'] );
    $router->get('/schedules/{id}', [ 'uses' => 'ScheduleController@show'] );
    $router->post('/schedules', [ 'uses' => 'ScheduleController@store'] );
    $router->put('/schedules/{id}', [ 'uses' => 'ScheduleController@update'] );
    $router->delete('/schedules/{id}', [ 'uses' => 'ScheduleController@destroy'] );
});