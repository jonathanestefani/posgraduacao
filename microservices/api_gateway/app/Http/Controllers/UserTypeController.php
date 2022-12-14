<?php

namespace App\Http\Controllers;

use App\Models\UserType;
use App\BaseRepository\Services\DestroyService;
use App\BaseRepository\Services\LoadService;
use App\BaseRepository\Services\StoreService;
use App\Services\UserType\ListAllService;
use App\Services\UserType\ListIndexService;
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
                $data = (new ListAllService(UserType::class))->setRequest($request)->execute();
            } else {
                $data = (new ListIndexService(UserType::class))->setRequest($request)->execute();
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

            $data = (new LoadService(UserType::class))->setRequest($params)->execute();
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
            $data = (new StoreService(UserType::class))->setRequest($request)->execute();

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
            $data = (new StoreService(UserType::class))->setRequest($request)->execute();

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

            (new DestroyService(UserType::class))->setRequest($request)->execute();

            return response()->json([]);
        } catch (ErrorServiceException $th) {
            return new Response(["message" => $th->getMessage()], 400);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return new Response(['message' => 'Ocorreu um erro ao tentar excluir o tipo de usuário!'], 500);
        }
    }
}
