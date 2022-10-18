<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\User\DestroyService;
use App\Services\User\ListAllService;
use App\Services\User\ListIndexService;
use App\Services\User\LoadService;
use App\Services\User\StoreService;
use App\Exceptions\ErrorServiceException;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['store']]);
    }

    public function index(Request $request)
    {
        try {
            $data = [];

            if ($request->all == true) {
                $data = (new ListAllService(User::class))->setRequest($request)->execute();
            } else {
                $data = (new ListIndexService(User::class))->setRequest($request)->execute();
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

            $data = (new LoadService(User::class))->setRequest($params)->execute();
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
            $validator = Validator::make($request->all(), [
                'user_type_id' => 'required|int|not_in:0',
                'name' => 'required|string',
                'email' => 'required|string',
                'password' => 'required|string',
            ], [
                'user_type_id' => "O tipo de usuário é obrigatório!",
                'name' => "O nome é obrigatório!",
                'email' => "O e-mail é obrigatório!",
                'password' => "Senha é obrigatório!",
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                return new Response(["message" => $errors], 422);
            }

            $data = (new StoreService(User::class))->setRequest($request)->execute();

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
            $validator = Validator::make($request->all(), [
                'user_type_id' => 'required|int|not_in:0',
                'name' => 'required|string',
                'email' => 'required|string',
                'password' => 'required|string',
            ], [
                'user_type_id' => "O tipo de usuário é obrigatório!",
                'name' => "O nome é obrigatório!",
                'email' => "O e-mail é obrigatório!",
                'password' => "Senha é obrigatório!",
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                return new Response(["message" => $errors], 422);
            }

            Log::info($request->all());

            $data = (new StoreService(User::class))->setRequest($request)->execute();

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

            (new DestroyService(User::class))->setRequest($request)->execute();

            return response()->json([]);
        } catch (ErrorServiceException $th) {
            return new Response(["message" => $th->getMessage()], 400);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return new Response(['message' => 'Ocorreu um erro ao tentar excluir o usuário!'], 500);
        }
    }
}
