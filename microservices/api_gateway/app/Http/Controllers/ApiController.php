<?php

namespace App\Http\Controllers;

use App\Exceptions\ErrorServiceException;
use Laravel\Lumen\Routing\Controller;

use App\Http\Controllers\Methods\GET;
use App\Http\Controllers\Methods\POST;
use App\Http\Controllers\Methods\PUT;
use App\Http\Controllers\Methods\LOAD;
use App\Http\Controllers\Methods\DELETE;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
    use GET, POST, PUT, LOAD, DELETE;

    private $address_api = "";
    private $api_name = "";
    private $resource = "";
    private $parameters = [];
    private $method = "";

    const url = [
        'empty' => 0,
        'api' => 1,
        'api_name' => 2
    ];

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    private function defineApiGateway(&$request) {
        $parameters = $request->server->all();

        if (!isset($parameters['REQUEST_METHOD'])) {
            return;
        }

        $this->defineResource($parameters);
        $this->defineMethod($parameters);
        $this->defineParameters($request);
        $this->defineApiName();
        $this->defineAddressApi();
    }

    private function defineResource(&$parameters) {
        $uri = $parameters['REQUEST_URI'];

        $divUrl = explode('?', $uri);
        $this->resource = trim($divUrl[0]);
    }

    private function defineMethod(&$parameters) {
        $this->method = $parameters['REQUEST_METHOD'];
    }

    private function defineApiName() {
        $this->api_name = trim(explode('/', $this->resource)[ self::url['api_name'] ]);
    }

    private function defineAddressApi() {
        $arr_api_names = config('api_gateway.api_names');

        if (isset($arr_api_names[$this->api_name])) {
            $this->address_api = $arr_api_names[$this->api_name];

            return true;
        }

        throw new ErrorServiceException('Recurso não identificado, favor verificar com o administrador!');
    }

    private function defineParameters(&$request) {
        switch ($this->method) {
            case 'GET':
                $this->parameters = $request->query->all(); // explode('&', $parameters['QUERY_STRING']);
                break;
            case 'POST':
                $this->parameters = $request->request->all();
                break;
            case 'PUT':
                $this->parameters = $request->request->all();
                break;
            case 'DELETE':
                $this->parameters = $request->request->all();
                break;
        }
    }

    public function callMethodGateway(&$request, &$router) {
        try {
            $parameters = $request->server->all();

            if (!isset($parameters['REQUEST_METHOD'])) {
                return;
            }

            $this->defineApiGateway($request);

            $route_apigateway = str_replace('/api', '', $this->resource);

            switch ($this->method) {
                case 'GET':
                    $router->addRoute("GET", $route_apigateway, ['uses' => 'ApiController@index']);
                    break;
                case 'POST':
                    $router->addRoute("POST", $route_apigateway, ['uses' => 'ApiController@store']);
                    break;
                case 'PUT':
                    $router->addRoute("PUT", $route_apigateway, ['uses' => 'ApiController@store']);
                    break;
                case 'DELETE':
                    $router->addRoute("DELETE", $route_apigateway, ['uses' => 'ApiController@store']);
                    break;
            }
        } catch(ErrorServiceException $th) {
            return new Response(["message" => $th->getMessage()], 401);
        } catch (\Throwable $th) {
            Log::info($th);

            return new Response(["message" => 'Houve um problema interno no sistema ao redirecionar para o recurso especialista!'], 500);
        }
    }
}
