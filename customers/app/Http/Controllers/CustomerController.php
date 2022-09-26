<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Services\Customers\DestroyService;
use App\Services\Customers\ListAllService;
use App\Services\Customers\ListIndexService;
use App\Services\Customers\LoadService;
use App\Services\Customers\StoreService;
use App\Exceptions\ErrorServiceException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;

class CustomerController extends Controller
{

    public function index(Request $request)
    {
        try {
            $data = [];

            if ($request->all == true) {
                $data = (new ListAllService(Customer::class))->setRequest($request)->execute();
            } else {
                $data = (new ListIndexService(Customer::class))->setRequest($request)->execute();
            }

            return response()->json($data);
        } catch (ErrorServiceException $th) {
            return new Response(["message" => $th->getMessage()], 400);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return new Response(["message" => "Ocorreu um erro ao carregar os dados dos clientes!"], 500);
        }
    }

    public function show($id)
    {
        try {
            $params = new Request([
                "id" => $id
            ]);

            $data = (new LoadService(Customer::class))->setRequest($params)->execute();
            return new Response($data);
        } catch (ErrorServiceException $th) {
            return new Response(["message" => $th->getMessage()], 400);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return new Response(['message' => 'Ocorreu um erro ao carregar os dados do cliente!'], 500);
        }
    }

    public function update(Request $request)
    {
        try {
            $data = (new StoreService(Customer::class))->setRequest($request)->execute();

            return response()->json($data);
        } catch (ErrorServiceException $th) {
            return new Response(["message" => $th->getMessage()], 400);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return new Response(['message' => 'Ocorreu um erro ao tentar atualizar cliente!'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = (new StoreService(Customer::class))->setRequest($request)->execute();

            return response()->json($data);
        } catch (ErrorServiceException $th) {
            return new Response(["message" => $th->getMessage()], 400);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return new Response(['message' => 'Ocorreu um erro ao tentar cadastrar o cliente!'], 500);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $data = (new DestroyService(Customer::class))->setRequest($request)->execute();

            return response()->json($data);
        } catch (ErrorServiceException $th) {
            return new Response(["message" => $th->getMessage()], 400);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return new Response(['message' => 'Ocorreu um erro ao tentar excluir o cliente!'], 500);
        }
    }
}
