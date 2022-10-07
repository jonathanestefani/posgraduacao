<?php

namespace App\Http\Controllers;

use App\Models\UsersTypes;
use App\Services\UsersTypes\DestroyService;
use App\Services\UsersTypes\ListAllService;
use App\Services\UsersTypes\ListIndexService;
use App\Services\UsersTypes\LoadService;
use App\Services\UsersTypes\StoreService;
use App\Exceptions\ErrorServiceException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;

class UserTypeController extends Controller
{

    public function index(Request $request)
    {
        try {
            $data = [];

            if ($request->all == true) {
                $data = (new ListAllService(UsersTypes::class))->setRequest($request)->execute();
            } else {
                $data = (new ListIndexService(UsersTypes::class))->setRequest($request)->execute();
            }

            return response()->json($data);
        } catch (ErrorServiceException $th) {
            return new Response(["message" => $th->getMessage()], 400);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return new Response(["message" => "Ocorreu um erro ao carregar os dados dos tipos de usuários!"], 500);
        }
    }

    public function show($id)
    {
        try {
            $params = new Request([
                "id" => $id
            ]);

            $data = (new LoadService(UsersTypes::class))->setRequest($params)->execute();
            return new Response($data);
        } catch (ErrorServiceException $th) {
            return new Response(["message" => $th->getMessage()], 400);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return new Response(['message' => 'Ocorreu um erro ao carregar os dados do tipo de usuário!'], 500);
        }
    }

    public function update($id, Request $request)
    {
        try {
            $data = (new StoreService(UsersTypes::class))->setRequest($request)->execute();

            return response()->json($data);
        } catch (ErrorServiceException $th) {
            return new Response(["message" => $th->getMessage()], 400);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return new Response(['message' => 'Ocorreu um erro ao tentar atualizar tipo de usuário!'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = (new StoreService(UsersTypes::class))->setRequest($request)->execute();

            return response()->json($data);
        } catch (ErrorServiceException $th) {
            return new Response(["message" => $th->getMessage()], 400);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return new Response(['message' => 'Ocorreu um erro ao tentar cadastrar o tipo de usuário!'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $request = new Request(['id' => $id]);

            (new DestroyService(UsersTypes::class))->setRequest($request)->execute();

            return response()->json([]);
        } catch (ErrorServiceException $th) {
            return new Response(["message" => $th->getMessage()], 400);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return new Response(['message' => 'Ocorreu um erro ao tentar excluir o tipo de usuário!'], 500);
        }
    }
}
