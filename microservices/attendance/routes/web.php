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
    $router->get('/attendances', [ 'uses' => 'AttendanceController@index'] );
    $router->get('/attendances/{id}', [ 'uses' => 'AttendanceController@show'] );
    $router->post('/attendances', [ 'uses' => 'AttendanceController@store'] );
    $router->put('/attendances/{id}', [ 'uses' => 'AttendanceController@update'] );
    $router->delete('/attendances/{id}', [ 'uses' => 'AttendanceController@destroy'] );

    $router->get('/', function () use ($router) {
        return $router->app->version();
    });
});