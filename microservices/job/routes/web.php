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

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

$router->group(['prefix' => 'api'], function () use ($router) {
    if (env('APP_ROUTE_DEBUG') == true) {
        $request = Request::capture();

        Log::info(print_r($request->server->all()));
    }

    $router->get('/jobs', [ 'uses' => 'JobController@index'] );
    $router->get('/jobs/{id}', [ 'uses' => 'JobController@show'] );
    $router->post('/jobs', [ 'uses' => 'JobController@store'] );
    $router->put('/jobs/{id}', [ 'uses' => 'JobController@update'] );
    $router->delete('/jobs/{id}', [ 'uses' => 'JobController@destroy'] );

    $router->get('/ratings', [ 'uses' => 'RatingController@index'] );
    $router->get('/ratings/{id}', [ 'uses' => 'RatingController@show'] );
    $router->post('/ratings', [ 'uses' => 'RatingController@store'] );
    $router->put('/ratings/{id}', [ 'uses' => 'RatingController@update'] );
    $router->delete('/ratings/{id}', [ 'uses' => 'RatingController@destroy'] );
});