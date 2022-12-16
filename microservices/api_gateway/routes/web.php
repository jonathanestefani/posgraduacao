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
use Laravel\Lumen\Http\Request;

$router->group(['prefix' => 'api'], function () use ($router) {
    // Matches "/api/register
    $router->get('users', 'UserController@index');
    $router->get('users/{id}', 'UserController@show');

    $router->post('record', 'UserController@store');
    $router->put('record/{id}', 'UserController@update');

    $router->post('login', 'AuthController@login');

    try {
        $request = Request::capture();

        if (env('APP_ROUTE_DEBUG') == true) {
            Log::info(print_r($request->server->all(), true));
        }

        (new ApiController())->callMethodGateway($request, $router);
    } catch (\Throwable $th) {
        echo 'Houve um problema interno no api gateway, favor verificar com o suporte técnico!';
        exit;
    }
});
