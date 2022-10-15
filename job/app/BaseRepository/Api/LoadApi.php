<?php

namespace App\BaseRepository\Api;

use App\Exceptions\ErrorApiCallException;
use App\Exceptions\ErrorServiceException;
use App\Services\Utils\UtilsService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;

class LoadApi
{
    private $api_name = "";
    private $key_local = "";
    private $value = "";
    private $alias = "";

    public function __construct($api_name, $key_local, $alias = "")
    {
        $this->api_name = $api_name;
        $this->key_local = $key_local;
        $this->alias = !empty($alias) ? $alias : $api_name;
    }

    public function setValue($value) {
        $this->value = $value;

        return $this;
    }

    public function getValue() {
        return $this->value;
    }

    public function getApi() {
        return $this->api_name;
    }

    public function getAlias() {
        return $this->alias;
    }

    public function getkeyLocal() {
        return $this->key_local;
    }

    public function loadRelation() {
        try {
            $address_api = UtilsService::getAddressApi($this->api_name);

            $response = Http::get($address_api . $this->api_name . '/' . $this->value, '');

            if ($response->failed()) {
                throw new ErrorApiCallException('Não foi possível buscar os dados na api');
            } else {
                return json_decode($response->body());    
            }
        } catch (ErrorApiCallException $th) {
            return new Response(["message" => $th->getMessage()], 404);
        } catch (ErrorServiceException $th) {
            return new Response(["message" => $th->getMessage()], 404);
        } catch (\Throwable $th) {
            Log::error($th);

            return new Response(["message" => "Ocorreu um erro ao carregar os dados!"], 500);
        }
    }

}