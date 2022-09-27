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

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Log;

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/{api_name}', [ 'uses' => 'ApiController@index'] );
    $router->get('/{api_name}/{id}', [ 'uses' => 'ApiController@show'] );
    $router->post('/{api_name}', [ 'uses' => 'ApiController@store'] );
    $router->put('/{api_name}/{id}', [ 'uses' => 'ApiController@update'] );
    $router->delete('/{api_name}/{id}', [ 'uses' => 'ApiController@destroy'] );

    /*
    $router->get('/', function () use ($router) {
        return $router->app->version();
    });
    */
});