<?php

namespace App\Http\Controllers\Methods;

use App\BaseRepository\Exceptions\ErrorApiCallException;
use App\Exceptions\ErrorServiceException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

trait GET
{
    public function index(Request $request)
    {
        try {
            $this->defineApiGateway($request);
            
            Log::info('index');

            Log::info($this->address_api.$this->resource);
            Log::info($this->parameters);

            $response = Http::get($this->address_api . $this->resource, $this->parameters);

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
