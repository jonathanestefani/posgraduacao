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
    $router->get('/customers', [ 'uses' => 'CustomerController@index'] );
    $router->get('/customers/{id}', [ 'uses' => 'CustomerController@show'] );
    $router->post('/customers', [ 'uses' => 'CustomerController@store'] );
    $router->put('/customers/{id}', [ 'uses' => 'CustomerController@update'] );
    $router->delete('/customers/{id}', [ 'uses' => 'CustomerController@destroy'] );

    $router->get('/', function () use ($router) {
        return $router->app->version();
    });
});