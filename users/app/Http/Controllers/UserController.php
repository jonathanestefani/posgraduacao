<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Services\Users\DestroyService;
use App\Services\Users\ListAllService;
use App\Services\Users\ListIndexService;
use App\Services\Users\LoadService;
use App\Services\Users\StoreService;
use App\Exceptions\ErrorServiceException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;

class UserController extends Controller
{

    public function index(Request $request)
    {
        try {
            $data = [];

            if ($request->all == true) {
                $data = (new ListAllService(Users::class))->setRequest($request)->execute();
            } else {
                $data = (new ListIndexService(Users::class))->setRequest($request)->execute();
            }

            return response()->json($data);
        } catch (ErrorServiceException $th) {
            return new Response(["message" => $th->getMessage()], 400);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return new Response(["message" => "Ocorreu um erro ao carregar os dados dos usuários!"], 500);
        }
    }

    public function show($id)
    {
        try {
            $params = new Request([
                "id" => $id
            ]);

            $data = (new LoadService(Users::class))->setRequest($params)->execute();
            return new Response($data);
        } catch (ErrorServiceException $th) {
            return new Response(["message" => $th->getMessage()], 400);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return new Response(['message' => 'Ocorreu um erro ao carregar os dados do usuário!'], 500);
        }
    }

    public function update($id, Request $request)
    {
        try {
            $data = (new StoreService(Users::class))->setRequest($request)->execute();

            return response()->json($data);
        } catch (ErrorServiceException $th) {
            return new Response(["message" => $th->getMessage()], 400);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return new Response(['message' => 'Ocorreu um erro ao tentar atualizar usuário!'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = (new StoreService(Users::class))->setRequest($request)->execute();

            return response()->json($data);
        } catch (ErrorServiceException $th) {
            return new Response(["message" => $th->getMessage()], 400);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return new Response(['message' => 'Ocorreu um erro ao tentar cadastrar o usuário!'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $request = new Request(['id' => $id]);

            (new DestroyService(Users::class))->setRequest($request)->execute();

            return response()->json([]);
        } catch (ErrorServiceException $th) {
            return new Response(["message" => $th->getMessage()], 400);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return new Response(['message' => 'Ocorreu um erro ao tentar excluir o usuário!'], 500);
        }
    }
}
