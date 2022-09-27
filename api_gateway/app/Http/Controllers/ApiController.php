<?php

namespace App\Http\Controllers;

use App\Exceptions\ErrorServiceException;
use Laravel\Lumen\Routing\Controller;

use App\Http\Controllers\Methods\GET;
use App\Http\Controllers\Methods\POST;
use App\Http\Controllers\Methods\PUT;
use App\Http\Controllers\Methods\LOAD;
use App\Http\Controllers\Methods\DELETE;

class ApiController extends Controller
{
    use GET, POST, PUT, LOAD, DELETE;

    private function getAddressApi($api_name) {
        $arr_api_names = config('api_gateway.api_names');

        if ($arr_api_names[$api_name]) {
            return config('api_gateway.protocol') . '://' . $arr_api_names[$api_name];
        }

        throw new ErrorServiceException('Recurso não identificado, favor verificar com o administrador!');
    }
}
