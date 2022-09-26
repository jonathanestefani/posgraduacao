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

use Illuminate\Support\Facades\Log;

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('gateway/{api:[A-Za-z]+}', function($api) {
        Log::info($api);

        return $api;
    } );

    $router->get('/', function () use ($router) {
        return $router->app->version();
    });
});