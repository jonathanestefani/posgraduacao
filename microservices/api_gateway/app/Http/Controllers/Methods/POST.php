<?php

namespace App\Http\Controllers\Methods;

use App\BaseRepository\Exceptions\ErrorApiCallException;
use App\Exceptions\ErrorServiceException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

trait POST
{
    public function store($api_name, Request $request)
    {
        try {
            $address_api = $this->getAddressApi($api_name);

            Log::info($address_api . $api_name);

            $response = Http::post($address_api . $api_name, $request->all());

            if ($response->failed()) {
                Log::info($response);

                throw new ErrorApiCallException('Não foi possível executar a operação na api');
            } else {
                return new Response($response->body());
            }
        } catch (ErrorApiCallException $th) {
            return new Response(["message" => $th->getMessage()], 404);
        } catch (ErrorServiceException $th) {
            return new Response(["message" => $th->getMessage()], 404);
        } catch (\Throwable $th) {
            Log::error($th);

            return new Response(["message" => "Ocorreu um erro interno ao tentar executar a operação!"], 500);
        }
    }

}
