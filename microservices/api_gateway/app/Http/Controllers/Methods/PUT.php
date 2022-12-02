<?php

namespace App\Http\Controllers\Methods;

use App\BaseRepository\Exceptions\ErrorApiCallException;
use App\Exceptions\ErrorServiceException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

trait PUT
{
    public function update()
    {
        try {
            Log::info($this->address_api . $this->resource);
            Log::info($this->parameters);

            return;

            $response = Http::put($this->address_api . $this->resource, $this->parameters);

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
