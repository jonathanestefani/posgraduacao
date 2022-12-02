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

    $router->get('/persons', [ 'uses' => 'PersonController@index'] );
    $router->get('/persons/{id}', [ 'uses' => 'PersonController@show'] );
    $router->post('/persons', [ 'uses' => 'PersonController@store'] );
    $router->put('/persons/{id}', [ 'uses' => 'PersonController@update'] );
    $router->delete('/persons/{id}', [ 'uses' => 'PersonController@destroy'] );
});