<?php

namespace App\Http\Controllers\Methods;

use App\BaseRepository\Exceptions\ErrorApiCallException;
use App\Exceptions\ErrorServiceException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

trait POST
{
    public function store(Request $request)
    {
        try {
            $this->defineApiGateway($request);

            $response = Http::post($this->address_api . $this->resource, $this->parameters);

            if ($response->failed()) {
                $response->throw();
            } else {
                return new Response($response->body());
            }
        } catch (RequestException $th) {
            return new Response($th->response, 404);
        } catch (ErrorApiCallException $th) {
            Log::info($th);
            return new Response(["message" => $th->getMessage()], 404);
        } catch (ErrorServiceException $th) {
            Log::info($th);
            return new Response(["message" => $th->getMessage()], 404);
        } catch (\Throwable $th) {
            Log::error($th);

            return new Response(["message" => "Ocorreu um erro ao carregar os dados!"], 500);
        }
    }

}
