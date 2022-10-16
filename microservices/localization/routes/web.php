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
    $router->get('/cities', [ 'uses' => 'CitiesController@index'] );
    $router->get('/cities/{id}', [ 'uses' => 'CitiesController@show'] );
    $router->post('/cities', [ 'uses' => 'CitiesController@store'] );
    $router->put('/cities', [ 'uses' => 'CitiesController@store'] );
    $router->delete('/cities', [ 'uses' => 'CitiesController@destroy'] );

    $router->get('/states', [ 'uses' => 'StatesController@index'] );
    $router->get('/states/{id}', [ 'uses' => 'StatesController@show'] );
    $router->post('/states', [ 'uses' => 'StatesController@store'] );
    $router->put('/states', [ 'uses' => 'StatesController@store'] );
    $router->delete('/states', [ 'uses' => 'StatesController@destroy'] );

    $router->get('/countries', [ 'uses' => 'CountriesController@index'] );
    $router->get('/countries/{id}', [ 'uses' => 'CountriesController@show'] );
    $router->post('/countries', [ 'uses' => 'CountriesController@store'] );
    $router->put('/countries', [ 'uses' => 'CountriesController@store'] );
    $router->delete('/countries', [ 'uses' => 'CountriesController@destroy'] );

    $router->get('/', function () use ($router) {
        return $router->app->version();
    });
});