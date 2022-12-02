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

    $router->get('/schedules/week', [ 'uses' => 'ScheduleWeekController@index'] );
    $router->get('/schedules/week/{id}', [ 'uses' => 'ScheduleWeekController@show'] );
    $router->post('/schedules/week', [ 'uses' => 'ScheduleWeekController@store'] );
    $router->put('/schedules/week/{id}', [ 'uses' => 'ScheduleWeekController@update'] );
    $router->delete('/schedules/week/{id}', [ 'uses' => 'ScheduleWeekController@destroy'] );

    $router->get('/schedules/time', [ 'uses' => 'ScheduleTimeController@index'] );
    $router->get('/schedules/time/{id}', [ 'uses' => 'ScheduleTimeController@show'] );
    $router->post('/schedules/time', [ 'uses' => 'ScheduleTimeController@store'] );
    $router->put('/schedules/time/{id}', [ 'uses' => 'ScheduleTimeController@update'] );
    $router->delete('/schedules/time/{id}', [ 'uses' => 'ScheduleTimeController@destroy'] );
});